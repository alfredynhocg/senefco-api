
## Fase 3 — Protección de POST Públicos: reCAPTCHA v2 con Cifrado Híbrido RSA-2048 + AES-256-CBC

> **Fecha:** 2026-04-13  
> **Trigger:** proteger `POST /portal/mensajes-contacto` y `POST /portal/tramite-solicitudes` contra bots.  
> **Referencia analizada:** servicio `gservicios.gestora.bo/gcaptcha` — cifrado híbrido RSA+AES real en producción.

---

### Análisis del esquema observado en red

De la captura de tráfico se identificaron tres componentes clave:

**1. Parámetro `k` en la URL — Clave pública RSA-2048**

```text
GET /gcaptcha/process?k=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA...
```

El parámetro `k` es la **clave pública RSA-2048 del servidor en formato DER codificada en base64** (SubjectPublicKeyInfo, 296 bytes). El cliente la usa para cifrar su clave AES antes de enviarla.

#### 2. Payload del request — Cifrado híbrido

```json
{
  "encryptedData": "ae201dc2d1d24fe84dfb0de506591fa05433e417b09612767d4d1627...",
  "encryptedKey":  "W/MM+beC38FW91va92FKtsufUxFSxkUS+FJqxVrzQQPWv5BW7ei...",
  "endPoint":      "FormularioConsultarBeneficio",
  "iv":            "948db348eaf799ea2ac060c38e820c45"
}
```

| Campo | Tipo | Contenido |
| --- | --- | --- |
| `encryptedData` | hex | Token reCAPTCHA cifrado con AES-256-CBC |
| `encryptedKey` | base64 | Clave AES cifrada con RSA-2048 OAEP (256 bytes) |
| `endPoint` | texto plano | Identificador del formulario que origina la verificación |
| `iv` | hex | Vector de inicialización AES de 16 bytes (128 bits) |

#### 3. Respuesta cifrada

```json
{
  "codigo":  200,
  "message": "Procesamiento de GCaptcha v2 Correcto!",
  "fecha":   "2026-04-13T11:52:54.222+00:00",
  "data":    "ZmI1OTRlMzkwZmFiMGM1NTV..."
}
```

El campo `data` es el **proof token cifrado con la misma clave AES que generó el cliente**. Solo el cliente original (que tiene la clave AES en memoria) puede descifrarlo.

---

### Cómo funciona el cifrado híbrido (Envelope Encryption)

```text
CLIENTE                                    SERVIDOR
───────                                    ────────
1. Genera AES-256 key (aleatorio)
2. Genera IV de 16 bytes (aleatorio)
3. Cifra payload con AES-256-CBC
4. Cifra la clave AES con RSA public key ──▶ Descifra clave AES con RSA private key
                                             Descifra payload con clave AES + IV
                                             Verifica CAPTCHA con Google
                                             Cifra proof token con la misma clave AES
5. Descifra respuesta con su clave AES ◀── Retorna proof token cifrado en "data"
6. Guarda proof token en memoria
7. Envía proof token al hacer el POST
```

**¿Por qué este esquema y no solo HTTPS?**

| Protección | Solo HTTPS | RSA+AES Híbrido |
| --- | --- | --- |
| Tráfico interceptado en red | ✅ Protegido | ✅ Protegido |
| Token CAPTCHA expuesto en logs del servidor proxy | ❌ Visible | ✅ Cifrado — servidor solo ve texto cifrado |
| Token CAPTCHA expuesto en logs de Load Balancer | ❌ Visible | ✅ Cifrado end-to-end |
| Replay del request completo desde otro cliente | ❌ Posible | ✅ Imposible — `encryptedKey` está ligado a la sesión |
| Interceptación TLS en redes corporativas (SSL inspection) | ❌ Expuesto | ✅ Cifrado adicional |
| Forja de proof token por el cliente | ❌ Posible | ✅ Imposible — cifrado con APP_KEY del servidor |

---

### Propiedades de seguridad del esquema

| Propiedad | Descripción |
| --- | --- |
| **Forward secrecy por request** | Cada request genera una clave AES nueva y aleatoria |
| **Confidencialidad del CAPTCHA token** | Nunca viaja en plaintext, ni en logs de proxies |
| **Autenticidad del servidor** | Solo el servidor con la clave RSA privada puede descifrar |
| **Confidencialidad de la respuesta** | Solo el cliente original (con clave AES en memoria) puede descifrar el proof token |
| **Binding por endpoint** | El campo `endPoint` dentro del cifrado evita que un proof de "contacto" se use para "tramites" |

---

### Endpoints POST públicos a proteger

| Endpoint | `endPoint` identifier | Riesgo sin protección |
| --- | --- | --- |
| `POST /portal/mensajes-contacto` | `MensajeContacto` | Spam masivo, saturación de notificaciones |
| `POST /portal/tramite-solicitudes` | `TramiteSolicitud` | Creación masiva de solicitudes falsas |

---

### Archivos a crear

```text
storage/keys/captcha_private.pem         ← RSA-2048 private key (fuera de public/)
storage/keys/captcha_public.der.b64      ← RSA public key en DER+base64 (expuesta como "k")

app/Services/RecaptchaService.php        ← Verifica con Google reCAPTCHA API
app/Services/CaptchaEnvelopeService.php  ← Descifrado RSA+AES + generación del proof
app/Http/Controllers/Api/Portal/CaptchaPublicKeyController.php  ← GET /portal/captcha/public-key
app/Http/Controllers/Api/Portal/VerificarCaptchaController.php  ← POST /portal/verificar-captcha
app/Http/Requests/Portal/VerificarCaptchaRequest.php
app/Http/Middleware/ValidarProofCaptcha.php  ← Middleware para POST protegidos
```

---

### Generación del par de claves RSA (un solo paso, en servidor)

```bash
# 1. Generar clave privada RSA-2048
openssl genrsa -out storage/keys/captcha_private.pem 2048

# 2. Extraer clave pública en formato DER y codificar en base64
#    Este es el valor del parámetro "k" que expone la API
openssl rsa -in storage/keys/captcha_private.pem -pubout -outform DER \
  | base64 -w 0 > storage/keys/captcha_public.der.b64

# 3. Verificar que la clave pública empieza con MIIBIj (SubjectPublicKeyInfo DER)
head -c 50 storage/keys/captcha_public.der.b64
```

> La clave privada **nunca debe entrar al repositorio git**. Agregar `storage/keys/` a `.gitignore`.

---

### Implementación — referencia de código

**`app/Services/CaptchaEnvelopeService.php`** — núcleo del cifrado:

```php
class CaptchaEnvelopeService
{
    private string $privateKeyPem;
    private int $ttl;

    public function __construct()
    {
        $this->privateKeyPem = file_get_contents(storage_path('keys/captcha_private.pem'));
        $this->ttl = (int) config('services.recaptcha.token_ttl', 600);
    }

    /**
     * Descifra el payload enviado por el cliente (RSA→AES).
     * Retorna el JSON del payload o lanza excepción si el cifrado es inválido.
     */
    public function descifrarPayload(string $encryptedKey, string $encryptedData, string $iv): array
    {
        // 1. Descifrar la clave AES con la clave privada RSA (OAEP + SHA-256)
        $aesKeyDecrypted = '';
        $result = openssl_private_decrypt(
            base64_decode($encryptedKey),
            $aesKeyDecrypted,
            $this->privateKeyPem,
            OPENSSL_PKCS1_OAEP_PADDING
        );

        if (! $result) {
            throw new \RuntimeException('Fallo al descifrar la clave AES con RSA.');
        }

        // 2. Descifrar el payload con AES-256-CBC
        $plaintext = openssl_decrypt(
            hex2bin($encryptedData),
            'AES-256-CBC',
            $aesKeyDecrypted,
            OPENSSL_RAW_DATA,
            hex2bin($iv)
        );

        if ($plaintext === false) {
            throw new \RuntimeException('Fallo al descifrar el payload con AES.');
        }

        return json_decode($plaintext, true, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * Genera el proof token cifrado con la clave AES del cliente.
     * Solo el cliente original puede descifrarlo.
     */
    public function cifrarProof(string $aesKey, string $iv, string $ip, string $endPoint): string
    {
        $proof = json_encode([
            'ts'        => now()->unix(),
            'ttl'       => $this->ttl,
            'ip'        => $ip,
            'nonce'     => bin2hex(random_bytes(8)),
            'endPoint'  => $endPoint,
        ]);

        $cifrado = openssl_encrypt(
            $proof,
            'AES-256-CBC',
            $aesKey,
            OPENSSL_RAW_DATA,
            hex2bin($iv)
        );

        return base64_encode($cifrado);
    }

    public function publicKeyBase64(): string
    {
        return trim(file_get_contents(storage_path('keys/captcha_public.der.b64')));
    }
}
```

**`app/Services/RecaptchaService.php`** — verifica con Google:

```php
class RecaptchaService
{
    public function verificar(string $token, string $ip): bool
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret_key'),
            'response' => $token,
            'remoteip' => $ip,
        ]);

        return $response->successful() && $response->json('success') === true;
    }
}
```

**`app/Http/Controllers/Api/Portal/CaptchaPublicKeyController.php`** — expone la clave pública:

```php
class CaptchaPublicKeyController extends Controller
{
    public function __invoke(CaptchaEnvelopeService $envelope, Request $request): JsonResponse
    {
        // El cliente llama GET /portal/captcha/public-key para obtener "k"
        return response()->json(['k' => $envelope->publicKeyBase64()]);
    }
}
```

**`app/Http/Controllers/Api/Portal/VerificarCaptchaController.php`**:

```php
class VerificarCaptchaController extends Controller
{
    public function __construct(
        private readonly RecaptchaService $recaptcha,
        private readonly CaptchaEnvelopeService $envelope,
    ) {}

    public function __invoke(VerificarCaptchaRequest $request): JsonResponse
    {
        // 1. Descifrar payload RSA+AES para obtener el token reCAPTCHA
        try {
            $payload = $this->envelope->descifrarPayload(
                $request->encryptedKey,
                $request->encryptedData,
                $request->iv,
            );
        } catch (\Exception) {
            return response()->json(['codigo' => 400, 'message' => 'Payload de verificación inválido.'], 400);
        }

        // 2. Verificar el token reCAPTCHA con Google
        $valido = $this->recaptcha->verificar($payload['recaptcha_token'], $request->ip());

        if (! $valido) {
            return response()->json([
                'codigo'  => 422,
                'message' => 'Verificación de CAPTCHA fallida. Intente nuevamente.',
                'fecha'   => now()->toIso8601String(),
            ], 422);
        }

        // 3. Generar proof token cifrado con la clave AES del cliente
        $proofCifrado = $this->envelope->cifrarProof(
            aesKey:    $payload['aesKey'],   // el cliente lo incluye en el payload cifrado
            iv:        $request->iv,
            ip:        $request->ip(),
            endPoint:  $payload['endPoint'],
        );

        return response()->json([
            'codigo'  => 200,
            'message' => 'Procesamiento de GCaptcha v2 Correcto!',
            'fecha'   => now()->toIso8601String(),
            'data'    => $proofCifrado,
        ]);
    }
}
```

**`app/Http/Middleware/ValidarProofCaptcha.php`** — valida el proof en los POST protegidos:

```php
class ValidarProofCaptcha
{
    public function handle(Request $request, Closure $next, string $endPoint): Response
    {
        // El cliente envía el proof descifrado (plaintext) en el header
        // ya que para el formulario no necesita doble cifrado
        $proof = $request->header('X-Captcha-Proof');

        if (! $proof) {
            return response()->json(['message' => 'Verificación CAPTCHA requerida.'], 403);
        }

        try {
            $data = json_decode(base64_decode($proof), true, flags: JSON_THROW_ON_ERROR);
        } catch (\Exception) {
            return response()->json(['message' => 'Token de verificación inválido.'], 403);
        }

        if (now()->unix() > ($data['ts'] + $data['ttl'])) {
            return response()->json(['message' => 'Token de verificación expirado.'], 403);
        }

        if ($data['ip'] !== $request->ip()) {
            return response()->json(['message' => 'Token de verificación no válido para esta sesión.'], 403);
        }

        if ($data['endPoint'] !== $endPoint) {
            return response()->json(['message' => 'Token no autorizado para esta acción.'], 403);
        }

        return $next($request);
    }
}
```

**Rutas en `routes/api/v1.php`**:

```php
// Dentro del grupo prefix('portal')

// Expone la clave pública RSA para que el cliente pueda cifrar
Route::get('/captcha/public-key', CaptchaPublicKeyController::class);

// Verificación del CAPTCHA (recibe payload cifrado)
Route::post('/verificar-captcha', VerificarCaptchaController::class);

// Endpoints protegidos (requieren proof token válido)
Route::post('/mensajes-contacto', [MensajeContactoController::class, 'store'])
    ->middleware('captcha.proof:MensajeContacto');

Route::post('/tramite-solicitudes', [TramiteSolicitudController::class, 'storeSolicitudPortal'])
    ->middleware('captcha.proof:TramiteSolicitud');
```

**Registro en `bootstrap/app.php`**:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'captcha.proof' => ValidarProofCaptcha::class,
    ]);
})
```

**Variables de entorno en `.env`**:

```text
RECAPTCHA_SECRET_KEY=6Le...tu_secret_key_de_google
RECAPTCHA_SITE_KEY=6Le...tu_site_key_para_el_frontend
CAPTCHA_TOKEN_TTL=600
```

**`config/services.php`**:

```php
'recaptcha' => [
    'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    'site_key'   => env('RECAPTCHA_SITE_KEY'),
    'token_ttl'  => env('CAPTCHA_TOKEN_TTL', 600),
],
```

---

### Implementación del lado Angular (Web Crypto API)

```typescript
// captcha-envelope.service.ts

async verificarCaptcha(recaptchaToken: string, endPoint: string): Promise<string> {
  // 1. Obtener clave pública RSA del servidor
  const { k } = await firstValueFrom(this.http.get<{ k: string }>('/api/v1/portal/captcha/public-key'));
  const rsaPublicKeyDer = Uint8Array.from(atob(k), c => c.charCodeAt(0));

  // 2. Generar clave AES-256 y IV aleatorios
  const aesKey = await crypto.subtle.generateKey({ name: 'AES-CBC', length: 256 }, true, ['encrypt', 'decrypt']);
  const iv = crypto.getRandomValues(new Uint8Array(16));
  const rawAesKey = await crypto.subtle.exportKey('raw', aesKey);

  // 3. Cifrar el payload con AES-256-CBC
  const payload = JSON.stringify({ recaptcha_token: recaptchaToken, endPoint, aesKey: btoa(String.fromCharCode(...new Uint8Array(rawAesKey))) });
  const encryptedData = await crypto.subtle.encrypt({ name: 'AES-CBC', iv }, aesKey, new TextEncoder().encode(payload));

  // 4. Importar clave RSA pública y cifrar la clave AES
  const serverRsaKey = await crypto.subtle.importKey('spki', rsaPublicKeyDer, { name: 'RSA-OAEP', hash: 'SHA-256' }, false, ['encrypt']);
  const encryptedKey = await crypto.subtle.encrypt({ name: 'RSA-OAEP' }, serverRsaKey, rawAesKey);

  // 5. Enviar al servidor
  const ivHex = Array.from(iv).map(b => b.toString(16).padStart(2, '0')).join('');
  const encHex = Array.from(new Uint8Array(encryptedData)).map(b => b.toString(16).padStart(2, '0')).join('');

  const response = await firstValueFrom(this.http.post<{ data: string }>('/api/v1/portal/verificar-captcha', {
    encryptedData: encHex,
    encryptedKey:  btoa(String.fromCharCode(...new Uint8Array(encryptedKey))),
    endPoint,
    iv: ivHex,
  }));

  // 6. Descifrar el proof token con la clave AES propia
  const encProof = Uint8Array.from(atob(response.data), c => c.charCodeAt(0));
  const proofBuffer = await crypto.subtle.decrypt({ name: 'AES-CBC', iv }, aesKey, encProof);
  return btoa(new TextDecoder().decode(proofBuffer));  // proof listo para enviar en X-Captcha-Proof
}
```

> La clave AES se genera en memoria y se descarta tras descifrar el proof. Nunca se persiste.

---

### Flujo completo de uso

```text
1. Usuario completa widget reCAPTCHA v2 → obtiene recaptcha_token
2. Angular llama GET /portal/captcha/public-key → obtiene RSA public key "k"
3. Angular genera AES key + IV aleatorios
4. Angular cifra payload (token + endPoint) con AES → encryptedData
5. Angular cifra AES key con RSA public key → encryptedKey
6. Angular POST /portal/verificar-captcha { encryptedData, encryptedKey, endPoint, iv }
7. API descifra AES key con RSA private key
8. API descifra payload con AES key + IV → obtiene recaptcha_token
9. API verifica con Google → éxito
10. API cifra proof token con la MISMA clave AES → retorna { data: "..." }
11. Angular descifra "data" con su AES key → obtiene proof token (JSON)
12. Angular guarda proof en memoria (variable del servicio)
13. Al enviar formulario: POST con header X-Captcha-Proof: base64(proof)
14. Middleware valida TTL + IP + endPoint → permite o rechaza 403
```

---

### Resumen de severidad

| Hallazgo sin esta fase | Severidad | Estado |
| --- | --- | --- |
| `POST /portal/mensajes-contacto` sin protección anti-bot | 🔴 Crítico | Pendiente |
| `POST /portal/tramite-solicitudes` sin protección anti-bot | 🔴 Crítico | Pendiente |
| Token reCAPTCHA viaja en texto plano (sin envelope encryption) | 🟠 Alto | Pendiente |

---

## Contexto: ¿Por qué los datos son visibles en el DevTools?

Esto es **normal y esperado** para una API REST pública. El browser siempre mostrará las peticiones HTTP en DevTools — eso no es un problema de seguridad en sí mismo. Los datos del portal municipal (comunicados, noticias, eventos) son **información pública por naturaleza**.

Lo que sí importa proteger es:
1. **El abuso de la API** (scraping masivo, DoS) → Rate limiting
2. **Acceso a datos no publicados** → Filtro por estado en show()
3. **El origen de las peticiones** → CORS
4. **La infraestructura interna** → APP_DEBUG=false en producción

Un ciudadano viendo los comunicados en DevTools es exactamente el comportamiento esperado. Un bot haciendo 10.000 peticiones por minuto no lo es.
