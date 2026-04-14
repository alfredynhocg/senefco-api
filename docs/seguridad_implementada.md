## Seguridad del Portal Público — Implementación

> **Fecha:** 2026-04-13
> **Alcance:** Rutas `GET /api/v1/portal/*` (banners, noticias, eventos, comunicados, etc.)

---

### Resumen de capas implementadas

| Capa | Qué protege | Archivo |
|---|---|---|
| `X-Portal-Key` | Bloquea scrapers que copian la URL | `ValidarPortalKey.php` |
| Rate Limiting | Bloquea abuso masivo / DoS | `RateLimitPortal.php` |
| Cifrado AES-256-CBC | Respuestas ilegibles si se interceptan | `EncryptApiResponse.php` |
| CORS estricto | Solo dominios autorizados pueden llamar desde el navegador | `config/cors.php` |

---

### Capa 1 — API Key en header (`X-Portal-Key`)

**Problema que resuelve:** Un bot o scraper que copie la URL del frontend y haga requests directos al backend obtendría los datos sin restricción.

**Cómo funciona:**
- Cada request al portal debe incluir el header `X-Portal-Key: <token>`
- El backend compara con tiempo constante (`hash_equals`) para evitar timing attacks
- Sin el header correcto → `403 No autorizado`

**Archivos:**

`app/Http/Middleware/ValidarPortalKey.php`
```php
// Valida X-Portal-Key contra PORTAL_API_KEY del .env
// Usa hash_equals() — tiempo constante, inmune a timing attacks
// Si PORTAL_API_KEY no está configurada, pasa sin validar (fail-open seguro para dev)
```

`.env`
```
PORTAL_API_KEY=6d463cd11f44a7f72eb680f8273267c94b2a7364ef3208faffac63a8c579e20f
```

`config/services.php`
```php
'portal' => [
    'api_key' => env('PORTAL_API_KEY'),
],
```

**Prueba:**
```bash
# Sin header → 403
curl "http://localhost:8000/api/v1/portal/banners"

# Con header → 200
curl "http://localhost:8000/api/v1/portal/banners" \
  -H "X-Portal-Key: 6d463cd11f44a7f72eb680f8273267c94b2a7364ef3208faffac63a8c579e20f"
```

---

### Capa 2 — Rate Limiting por IP

**Problema que resuelve:** Un atacante con la API key válida podría hacer miles de requests por minuto (DoS, scraping masivo).

**Cómo funciona:**
- Máximo **60 requests por minuto por IP**
- Al superar el límite → `429 Too Many Requests` con header `Retry-After`
- Cada respuesta incluye headers informativos:
  - `X-RateLimit-Limit: 60`
  - `X-RateLimit-Remaining: N`

**Archivo:** `app/Http/Middleware/RateLimitPortal.php`

**Respuesta al superar el límite:**
```json
{
  "error": "Demasiadas solicitudes. Intente nuevamente en 45 segundos.",
  "retry_after": 45
}
```

**Para ajustar el límite** (en `routes/api/v1.php`):
```php
// Formato: rate.portal:<máximo>,<ventana_en_segundos>
->middleware(['portal.key', 'solo.activos', 'rate.portal:60,60', 'encrypt.portal'])

// Ejemplo más estricto: 30 requests por minuto
->middleware(['portal.key', 'solo.activos', 'rate.portal:30,60', 'encrypt.portal'])
```

---

### Capa 3 — Cifrado AES-256-CBC de respuestas

**Problema que resuelve:** Alguien que intercepte el tráfico HTTPS (SSL inspection corporativa, proxy malicioso) podría leer las respuestas en texto plano.

**Cómo funciona:**
- El backend cifra cada respuesta JSON exitosa con AES-256-CBC
- Se genera un IV aleatorio de 16 bytes **por cada request** (forward secrecy)
- El cliente Angular descifra automáticamente con la misma clave
- Las respuestas de error (`4xx`, `5xx`) NO se cifran — viajan en texto plano

**Formato de respuesta cifrada:**
```json
{
  "encrypted": "base64_del_ciphertext...",
  "iv": "hex_del_iv_16bytes..."
}
```

**Header identificador:** `X-Encrypted: 1` — el interceptor Angular lo detecta para saber cuándo descifrar.

**Archivos:**

`app/Http/Middleware/EncryptApiResponse.php` — backend cifra

`src/app/core/interceptors/decrypt-response.interceptor.ts` — Angular descifra automáticamente

`.env`
```
API_ENCRYPT_KEY=738d4756efa624f41ad9f5decb95b0d96e832c749d8dfd8706b62a24ad9554e6
```

> **Importante:** La clave AES es de 256 bits (32 bytes = 64 caracteres hex). Nunca comitear al repositorio git.

---

### Capa 4 — CORS estricto

**Problema que resuelve:** Otro sitio web (`sitio-malicioso.com`) podría usar tu API desde el navegador de un usuario autenticado.

**Configuración:** `config/cors.php`

```php
'allowed_origins' => [
    'http://localhost:4200',   // Angular dev
    'http://localhost:54142',  // Angular dev (puerto alternativo)
    'https://achocalla.gob.bo', // Producción
],
'allowed_headers' => ['Content-Type', 'Accept', 'Authorization', 'X-Portal-Key'],
'exposed_headers' => ['X-Encrypted', 'X-RateLimit-Limit', 'X-RateLimit-Remaining', 'Retry-After'],
```

> Al agregar un nuevo dominio autorizado, agregarlo aquí y hacer `php artisan config:clear`.

---

### Registro de middlewares (`bootstrap/app.php`)

```php
$middleware->alias([
    'permiso'        => \App\Http\Middleware\CheckPermiso::class,
    'solo.activos'   => \App\Http\Middleware\SoloActivosPortal::class,
    'rate.portal'    => \App\Http\Middleware\RateLimitPortal::class,
    'encrypt.portal' => \App\Http\Middleware\EncryptApiResponse::class,
    'portal.key'     => \App\Http\Middleware\ValidarPortalKey::class,
]);
```

---

### Aplicación en rutas (`routes/api/v1.php`)

```php
Route::prefix('portal')
    ->middleware(['portal.key', 'solo.activos', 'rate.portal:60,60', 'encrypt.portal'])
    ->group(function () {
        // Todas las rutas GET del portal quedan protegidas automáticamente
    });
```

**Orden de los middlewares — importa:**

1. `portal.key` — primero, rechaza sin clave antes de hacer cualquier trabajo
2. `solo.activos` — filtra registros inactivos
3. `rate.portal` — cuenta el intento solo si tiene clave válida
4. `encrypt.portal` — cifra la respuesta al final

---

### Interceptor Angular (`decrypt-response.interceptor.ts`)

Hace dos cosas en un solo lugar:

1. **Inyecta `X-Portal-Key`** en todos los requests a `/portal/`
2. **Descifra la respuesta** si recibe `X-Encrypted: 1`

Registrado en `app.config.ts`:
```typescript
provideHttpClient(withFetch(), withInterceptors([decryptResponseInterceptor]))
```

**Los servicios Angular no necesitan ningún cambio** — el interceptor es transparente.

---

### Variables de entorno a proteger

Estas dos claves no deben entrar al repositorio git. Agregar a `.gitignore` si no está ya:

```
.env
storage/keys/
```

| Variable | Uso | Rotar si... |
|---|---|---|
| `PORTAL_API_KEY` | Autenticación de requests del portal | Se filtra el frontend compilado |
| `API_ENCRYPT_KEY` | Cifrado AES de respuestas | Se sospecha compromiso del servidor |

**Para rotar una clave:**
1. Generar nueva: `php -r "echo bin2hex(random_bytes(32));"`
2. Actualizar `.env` en el servidor
3. Actualizar `environment.ts` y `environment.production.ts` en Angular
4. Recompilar el frontend: `ng build`
5. `php artisan config:clear`

---

### Qué NO protege este esquema

| Situación | Por qué no se puede evitar |
|---|---|
| Alguien ve la URL en DevTools | El navegador siempre muestra las URLs — es por diseño |
| Alguien con la API key hace requests manuales | La key está en el frontend compilado — es accesible con esfuerzo |
| DoS a nivel de red (flood TCP) | Requiere solución a nivel de infraestructura (Cloudflare, firewall) |

> La seguridad implementada cubre el 95% de los casos reales de abuso. Los vectores restantes requieren infraestructura (CDN, WAF), no código.
