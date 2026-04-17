# Análisis de Seguridad — API Alcaldía Municipal

> Fecha: 2026-04-08  
> Alcance: `api_cenefco` — endpoints públicos `/api/v1/portal/*` y configuración general  
> Contexto: Portal institucional municipal boliviano. Las rutas `/portal/*` son intencionalmente públicas para el frontend ciudadano.

---

## Resumen Ejecutivo

La API tiene una buena base de seguridad en las rutas protegidas (autenticación Sanctum + sistema de permisos granular). Sin embargo, los endpoints públicos del portal presentan vulnerabilidades que deben corregirse antes de salir a producción.

| Severidad | Cantidad | Estado |
|-----------|----------|--------|
| 🔴 Crítico | 2 | Sin corregir |
| 🟠 Alto    | 3 | Sin corregir |
| 🟡 Medio   | 2 | Sin corregir |
| 🟢 Bajo    | 2 | Sin corregir |

---

## Hallazgos

---

### 🔴 CRÍTICO — Sin Rate Limiting en endpoints públicos

**Archivo:** `app/Providers/AppServiceProvider.php`

**Descripción:**  
Las rutas `/api/v1/portal/*` no tienen throttling configurado. Solo lo tienen login (5/min) y forgot-password (3/10min). Cualquier actor puede:
- Hacer scraping masivo de toda la base de datos
- Enumerar todos los registros por ID (1, 2, 3...)
- Saturar el servidor con peticiones masivas (DoS)

**Evidencia:**
```php
// AppServiceProvider.php — Solo protege auth
RateLimiter::for('login', fn ($req) => Limit::perMinute(5)->by($req->email . '|' . $req->ip()));
// ← No existe ningún limiter para rutas del portal
```

**Corrección:**
```php
// En AppServiceProvider.php — agregar en boot()
RateLimiter::for('portal', function (Request $request) {
    return Limit::perMinute(60)->by($request->ip());
});
```
```php
// En routes/api/v1.php
Route::prefix('portal')->middleware(['solo.activos', 'throttle:portal'])->group(function () {
    // ... rutas del portal
});
```

---

### 🔴 CRÍTICO — Enumeración de recursos no publicados en show()

**Archivos:** Repositorios de `Noticias`, `Comunicados`, `Eventos`, etc.

**Descripción:**  
El middleware `solo.activos` solo inyecta `soloActivos=true` para el método `index()`. El método `show(int $id)` llama directamente a `findById()` sin filtrar por estado. Un atacante puede acceder a borradores, registros privados o archivados sabiendo el ID.

**Evidencia:**
```php
// EloquentNoticiaRepository.php
public function findById(int $id): NoticiaDTO
{
    $model = Noticia::with(['categoria', 'etiquetas'])->find($id); // ← Sin filtro estado
    if (! $model) throw new NoticiaNotFoundException($id);
    return NoticiaDTO::fromModel($model);
}
```

**Corrección en repositorios de módulos con portal público:**
```php
public function findByIdPublico(int $id): NoticiaDTO
{
    $model = Noticia::with(['categoria', 'etiquetas'])
        ->where('estado', 'publicado')
        ->find($id);
    if (! $model) throw new NoticiaNotFoundException($id);
    return NoticiaDTO::fromModel($model);
}
```
Y en el controller del portal usar `findByIdPublico()` en lugar de `findById()`.

---

### 🟠 ALTO — APP_DEBUG=true expone información interna

**Archivo:** `.env`

**Descripción:**  
Con `APP_DEBUG=true`, cualquier error no controlado retorna el stack trace completo al cliente, exponiendo: rutas de archivos del servidor, queries SQL, variables de entorno y estructura interna del código.

**Evidencia:**
```env
APP_ENV=local
APP_DEBUG=true   ← Nunca debe ser true en producción
```

**Corrección:**
```env
# .env de producción
APP_ENV=production
APP_DEBUG=false
```
En desarrollo local está bien, pero debe estar documentado y verificado antes del deploy.

---

### 🟠 ALTO — Sin configuración explícita de CORS

**Descripción:**  
No existe `config/cors.php`. Laravel permite CORS desde cualquier origen por defecto. En producción, cualquier sitio web externo puede hacer peticiones a la API y mostrar los datos institucionales en contextos no autorizados.

**Corrección — crear `config/cors.php`:**
```php
<?php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    'allowed_origins' => [
        'http://localhost:4200',   // Frontend dev
        'http://localhost:61936',  // Otro puerto dev
        'https://www.cenefco-achocalla.gob.bo',  // Producción frontend
    ],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With'],
    'exposed_headers' => [],
    'max_age' => 86400,
    'supports_credentials' => true,
];
```

---

### 🟠 ALTO — Tokens sensibles expuestos

**Archivo:** `.env`

**Descripción:**  
El `.env` contiene tokens reales de WhatsApp/Meta. Si este archivo llega a un repositorio git (por accidente o por un commit), los tokens quedan expuestos permanentemente en el historial.

**Tokens encontrados:**
```env
WHATSAPP_ACCESS_TOKEN=EAARhzz4mRZB8BR...   ← Token Meta real
WHATSAPP_VERIFY_TOKEN=5dv4rrgq8au7
```

**Acciones inmediatas:**
1. Verificar que `.env` esté en `.gitignore` — `git check-ignore -v .env`
2. Revocar y rotar el `WHATSAPP_ACCESS_TOKEN` en Meta for Developers
3. Nunca poner tokens reales en `.env.example`

---

### 🟡 MEDIO — Nómina de personal completamente pública

**Archivo:** `routes/api/v1.php`

**Descripción:**  
El endpoint `/api/v1/portal/nomina-personal` expone datos de empleados públicos sin ninguna restricción adicional. Aunque en Bolivia la nómina pública es información de transparencia, el detalle de los campos expuestos debe revisarse.

**Corrección sugerida:**  
Revisar el DTO de `NominaPersonal` y asegurarse de que solo expone: nombre, cargo y unidad. Excluir: CI, fecha de nacimiento, salario neto, datos de contacto personal.

---

### 🟡 MEDIO — Headers de seguridad HTTP faltantes

**Descripción:**  
La API no envía headers de seguridad estándar que protegen contra ataques de clickjacking, sniffing de contenido y otros vectores.

**Corrección — agregar middleware en `bootstrap/app.php`:**
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->append(function ($request, $next) {
        $response = $next($request);
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        return $response;
    });
})
```

---

### 🟢 BAJO — Logs de acceso sospechoso

**Descripción:**  
No hay registro de intentos de enumeración. Si un actor intenta acceder a 500 IDs en secuencia, no queda registro para detectarlo.

**Corrección sugerida:**  
Agregar logging en los `NotFoundException` de los repositorios públicos para detectar patrones de enumeración.

---

### 🟢 BAJO — Paginación sin límite máximo de pageSize

**Descripción:**  
El parámetro `pageSize` en los endpoints de listado no tiene un máximo definido. Un actor puede pedir `pageSize=99999` y obtener toda la base de datos en una sola petición.

**Evidencia:**
```php
// GetComunicadosQueryHandler — sin validación de pageSize
$pageSize = (int) ($filters['pageSize'] ?? 10);  // ← Sin máximo
```

**Corrección:**
```php
$pageSize = min((int) ($filters['pageSize'] ?? 10), 100); // Máximo 100 por página
```

---

## Lo que está bien

- ✅ Autenticación Sanctum en todas las rutas admin
- ✅ Sistema de permisos granular (`permiso:recurso.accion`)
- ✅ Manejo de excepciones centralizado — no expone detalles internos en errores 500
- ✅ HTTPS forzado en producción (`AppServiceProvider`)
- ✅ SQL Injection mitigado (Eloquent ORM, sin raw SQL)
- ✅ Soft deletes en usuarios
- ✅ Contraseñas hasheadas (bcrypt)
- ✅ Rate limiting en login y forgot-password
- ✅ Datos de seeders separados de datos reales

---

## Plan de acción priorizado

### Antes de salir a producción (Obligatorio)

| # | Acción | Archivo | Tiempo estimado |
|---|--------|---------|-----------------|
| 1 | Agregar `throttle:60,1` a rutas del portal | `routes/api/v1.php` + `AppServiceProvider.php` | 30 min |
| 2 | Filtrar por `estado=publicado` en `show()` de repositorios públicos | Repositorios de Noticias, Comunicados, Eventos | 1 hora |
| 3 | Crear `config/cors.php` con orígenes permitidos explícitos | `config/cors.php` | 20 min |
| 4 | Verificar `.env` fuera de git y rotar tokens WhatsApp | `.gitignore`, Meta Dashboard | 30 min |
| 5 | `APP_DEBUG=false` en `.env` de producción | `.env` producción | 5 min |
| 6 | Limitar `pageSize` máximo a 100 en todos los QueryHandlers públicos | QueryHandlers | 30 min |

### Mejoras recomendadas (No bloqueantes)

| # | Acción | Impacto |
|---|--------|---------|
| 7 | Agregar headers de seguridad HTTP | Medio |
| 8 | Revisar campos expuestos en DTO de nómina | Alto (privacidad) |
| 9 | Implementar logging de accesos sospechosos | Medio |

---

## Console Warning — Protección Self-XSS (Facebook / DragonBound pattern)

### ¿Qué es esto?

Facebook muestra un mensaje de advertencia en la consola del browser para evitar ataques **Self-XSS**: ingeniería social donde alguien convence a un usuario de pegar código JavaScript malicioso en la consola, robando así su sesión o datos.

DragonBound va más allá con un ASCII art de advertencia anti-cheat/anti-manipulación.

Ambas son medidas de **seguridad del frontend**, no del backend.

### Implementación recomendada para `frontend_cenefco`

Agregar en `src/main.ts` (se ejecuta una sola vez al iniciar la app):

```typescript
// src/main.ts
if (typeof window !== 'undefined') {
  // Limpiar consola y mostrar advertencia
  console.clear();

  // Mensaje estilo Facebook — advertencia Self-XSS
  console.log(
    '%c¡Detente!',
    'color: red; font-size: 48px; font-weight: bold;'
  );
  console.log(
    '%cEsta función del navegador está pensada para desarrolladores.\n' +
    'Si alguien te indicó que copiaras y pegaras algo aquí para\n' +
    'acceder a funciones especiales o "hackear" algo, se trata\n' +
    'de un fraude. Esa persona podría acceder a tu cuenta.',
    'font-size: 14px; color: #333;'
  );

  // Mensaje institucional estilo DragonBound — ASCII art
  console.log(
    '%c' +
    '╔══════════════════════════════════════════════════════╗\n' +
    '║     GOBIERNO AUTÓNOMO MUNICIPAL DE ACHOCALLA         ║\n' +
    '║     Portal Institucional — Sistema Interno           ║\n' +
    '╠══════════════════════════════════════════════════════╣\n' +
    '║  ¿Eres desarrollador? Consulta nuestra documentación ║\n' +
    '║  en el área de TI de la Alcaldía Municipal.          ║\n' +
    '║                                                      ║\n' +
    '║  Cualquier acceso no autorizado será registrado      ║\n' +
    '║  y reportado a las autoridades competentes.          ║\n' +
    '╚══════════════════════════════════════════════════════╝',
    'color: #8B0000; font-family: monospace; font-size: 12px; font-weight: bold;'
  );
}
```

### ¿Por qué funciona?

| Técnica | Qué hace | Contra qué protege |
|---------|----------|--------------------|
| Mensaje `¡Detente!` en rojo grande | Llama la atención visualmente | Self-XSS — ingeniería social |
| Texto explicativo del fraude | Educa al usuario | Usuarios no técnicos engañados |
| ASCII art institucional | Da legitimidad y contexto | Confusión sobre si el sitio es oficial |
| Aviso de registro de accesos | Disuasión psicológica | Curiosos y atacantes oportunistas |

### Limitaciones

- **No detiene a desarrolladores** — cualquier persona técnica puede ignorarlo o desactivar la consola
- **No es una medida técnica** — es disuasión psicológica y educación del usuario
- **Complementa**, no reemplaza, las medidas de backend (rate limiting, CORS, autenticación)

---

---

## Fase 2 — Information Disclosure: Exposición de Metadata Interna en Endpoints Públicos

> **Fecha:** 2026-04-13  
> **Trigger:** endpoint `/api/v1/portal/preguntas-frecuentes` retorna campos internos (`id`, `activo`, `created_at`) innecesarios para el frontend ciudadano.  
> **Alcance:** todos los endpoints bajo el prefijo `/api/v1/portal/*`

---

### Descripción del problema

La API reutiliza los **mismos DTOs** para las rutas del panel de administración y las rutas públicas del portal. Esto provoca que el portal ciudadano devuelva campos de metadata interna que no tienen valor para el frontend pero sí para un atacante.

**Ejemplo concreto — respuesta actual de `/portal/preguntas-frecuentes`:**

```json
{
  "id": 1,
  "pregunta": "¿Cómo puedo obtener un certificado de residencia?",
  "respuesta": "...",
  "categoria": "Trámites",
  "orden": 1,
  "activo": true,
  "created_at": "2026-04-06T15:10:20+00:00"
}
```

**Respuesta que debería retornar el portal:**

```json
{
  "pregunta": "¿Cómo puedo obtener un certificado de residencia?",
  "respuesta": "...",
  "categoria": "Trámites",
  "orden": 1
}
```

---

### Vectores de ataque habilitados por esta exposición

| Campo expuesto | Vector de ataque | Severidad |
|---|---|---|
| `id` secuencial | **Enumeración de recursos**: el atacante itera `?id=1,2,3...` para mapear todos los registros, incluso los inactivos | 🟠 Alto |
| `activo: true` en todas las respuestas | **Confirmación de estado interno**: permite inferir que existen registros con `activo=false` y construir ataques de fuerza bruta contra el endpoint admin | 🟡 Medio |
| `created_at` | **Fingerprinting temporal**: el atacante correlaciona fechas de creación con eventos políticos/institucionales, obtiene inteligencia sobre ritmo de publicación | 🟡 Medio |
| `estado: "publicado"` (Noticias/Comunicados) | **State leakage**: confirma que el sistema gestiona estados internos (`borrador`, `archivado`) y guía ataques al panel admin | 🟡 Medio |
| `autor_id`, `categoria_id`, `secretaria_id` | **FK exposure**: revela IDs internos de otras tablas; permite correlación cruzada y enumeración de usuarios/categorías | 🟠 Alto |
| `ci` en NominaPersonal | **Exposición de PII (Cédula de Identidad)**: dato personal sensible protegido por ley; vector de fraude de identidad | 🔴 **Crítico** |
| `usuario_id` en NominaPersonal | **User enumeration**: vincula funcionarios con cuentas de usuario del sistema; facilita ataques dirigidos | 🔴 **Crítico** |
| `nivel_salarial` en NominaPersonal | **Privacy breach**: nivel salarial es dato interno aunque la nómina sea pública; solo corresponde exponer cargo | 🟠 Alto |
| `creado_por` en Eventos | **Internal user leak**: ID del usuario que creó el evento; facilita enumeración de usuarios admin | 🟠 Alto |
| `tipo_evento_id` FK en Eventos | **FK enumeration** hacia tabla de tipos | 🟡 Medio |

---

### Patrón de corrección — Public DTO por módulo

La solución es crear un **DTO reducido exclusivo para el portal** (`{Modulo}PublicDTO`) que solo exponga los campos necesarios para renderizar la vista ciudadana. El `SoloActivosPortal` middleware ya inyecta `soloActivos=true` en todas las rutas del portal — ese flag es el punto de bifurcación.

**Estructura del patrón:**

```text
app/Application/{Modulo}/DTOs/
├── {Modulo}DTO.php          ← DTO completo (admin + portal actual)
└── {Modulo}PublicDTO.php    ← DTO reducido (solo portal, NUEVO)
```

**Implementación en el QueryHandler:**

```php
// Get{Modulo}QueryHandler.php
public function handle(Get{Modulo}Query $query): array
{
    $result = $this->repository->paginate($query->pagination, $query->soloActivos);

    if ($query->soloActivos) {
        $result['data'] = array_map(
            fn ($dto) => {Modulo}PublicDTO::fromDto($dto),
            $result['data']
        );
    }

    return $result;
}
```

**Estructura del PublicDTO:**

```php
final readonly class {Modulo}PublicDTO
{
    public function __construct(
        // Solo campos necesarios para el frontend ciudadano
    ) {}

    public static function fromDto({Modulo}DTO $dto): self
    {
        return new self(
            // Mapear solo los campos permitidos
        );
    }
}
```

> No se modifican rutas, modelos, repositorios ni controllers. El cambio es únicamente en la capa Application (QueryHandler + nuevo DTO).

---

### Plan de implementación por módulo

| # | Módulo | Endpoint portal | Severidad | Campos a ELIMINAR del portal | Campos a MANTENER |
|---|---|---|---|---|---|
| 1 | **NominaPersonal** | `/portal/nomina-personal` | 🔴 Crítico | `id`, `usuario_id`, `secretaria_id`, `ci`, `nivel_salarial`, `activo`, `created_at` | `nombre`, `apellido`, `cargo`, `tipo_contrato`, `gestion`, `secretaria_nombre` |
| 2 | **PreguntasFrecuentes** | `/portal/preguntas-frecuentes` | 🟠 Alto | `id`, `activo`, `created_at` | `pregunta`, `respuesta`, `categoria`, `orden` |
| 3 | **Noticias** | `/portal/noticias`, `/portal/noticias/{id}`, `/portal/noticias/slug/{slug}` | 🟠 Alto | `categoria_id`, `autor_id`, `estado`, `created_at` | `id`*, `titulo`, `slug`, `entradilla`, `cuerpo`, `imagen_principal_url`, `imagen_alt`, `destacada`, `fecha_publicacion`, `vistas`, `meta_titulo`, `meta_descripcion`, `etiquetas`, `categoria` (solo nombre) |
| 4 | **Comunicados** | `/portal/comunicados`, `/portal/comunicados/{id}`, `/portal/comunicados/slug/{slug}` | 🟠 Alto | `estado`, `created_at` | `id`*, `titulo`, `slug`, `resumen`, `cuerpo`, `imagen_url`, `archivo_url`, `destacado`, `vistas`, `fecha_publicacion` |
| 5 | **Eventos** | `/portal/eventos`, `/portal/eventos/{id}` | 🟠 Alto | `tipo_evento_id`, `creado_por`, `estado`, `created_at` | `id`*, `titulo`, `slug`, `descripcion`, `lugar`, `latitud`, `longitud`, `fecha_inicio`, `fecha_fin`, `todo_el_dia`, `url_transmision`, `publico`, `tipo_nombre` |
| 6 | **Autoridades** | `/portal/autoridades`, `/portal/autoridades/{id}` | 🟡 Medio | `secretaria_id`, `activo`, `orden` | `nombre`, `apellido`, `cargo`, `tipo`, `perfil_profesional`, `email_institucional`, `foto_url`, `fecha_inicio_cargo`, `fecha_fin_cargo`, `slug` |
| 7 | **Secretarias** | `/portal/secretarias`, `/portal/secretarias/{id}` | 🟡 Medio | `activa`, `orden_organigrama`, `created_at` | `nombre`, `sigla`, `atribuciones`, `direccion_fisica`, `telefono`, `email`, `horario_atencion`, `foto_titular_url`, `slug` |
| 8 | **Subcenefcos** | `/portal/subcenefcos`, `/portal/subcenefcos/{id}` | 🟡 Medio | `activa` (o `activo`), `created_at` | campos de visualización pública |
| 9 | **BannersPortal** | `/portal/banners`, `/portal/banners/{id}` | 🟡 Medio | `activo`, `orden` | `titulo`, `descripcion`, `imagen_url`, `enlace_url`, `fecha_inicio`, `fecha_fin` |
| 10 | **DocumentosTransparencia** | `/portal/documentos-transparencia`, `/portal/documentos-transparencia/{id}` | 🟡 Medio | `activo` o `estado` interno, `created_at` | campos de visualización pública |
| 11 | **AudienciasPublicas** | `/portal/audiencias-publicas`, `/portal/audiencias-publicas/{id}` | 🟡 Medio | `estado` interno, `created_at` | campos de visualización pública |
| 12 | **Proyectos** | `/portal/proyectos` | 🟡 Medio | `activo`, `created_at` | campos de visualización pública |
| 13 | **Galerias / GaleriaItems** | `/portal/galerias`, `/portal/galeria-items` | 🟢 Bajo | `activo`, `created_at` | campos de visualización pública |

> `*` El `id` puede mantenerse en Noticias/Comunicados/Eventos solo si el frontend lo usa para navegar al detalle (rutas `/slug/{slug}` son preferibles). Si se usan rutas de slug, eliminar `id` también.

---

### Caso especial — NominaPersonal (🔴 Crítico)

El endpoint `/portal/nomina-personal` expone la **Cédula de Identidad** (`ci`) de los funcionarios municipales. Esto es:

1. **Violación de privacidad**: el `ci` es dato personal sensible bajo la legislación boliviana
2. **Vector de fraude**: permite suplantación de identidad o ingeniería social dirigida
3. **Incumplimiento de transparencia**: la nómina pública requiere cargo y nombre, no datos personales identificatorios

El campo `nivel_salarial` también debe ser eliminado del portal. En Bolivia, la transparencia salarial aplica al **cargo y escala**, no al nivel nominal individual.

**Campos a exponer en `/portal/nomina-personal`:**

```json
{
  "nombre": "Juan",
  "apellido": "Mamani",
  "cargo": "Técnico en Sistemas",
  "tipo_contrato": "planta",
  "gestion": 2026,
  "secretaria_nombre": "Secretaría de Planificación"
}
```

**Campos a eliminar del portal**: `id`, `usuario_id`, `secretaria_id`, `ci`, `nivel_salarial`, `activo`, `created_at`

---

### Archivos a crear por módulo (referencia rápida)

```text
app/Application/NominaPersonal/DTOs/NominaPersonalPublicDTO.php
app/Application/PreguntasFrecuentes/DTOs/PreguntaFrecuentePublicDTO.php
app/Application/Noticias/DTOs/NoticiaPublicDTO.php
app/Application/Comunicados/DTOs/ComunicadoPublicDTO.php
app/Application/Eventos/DTOs/EventoPublicDTO.php
app/Application/Autoridades/DTOs/AutoridadPublicDTO.php
app/Application/Secretarias/DTOs/SecretariaPublicDTO.php
app/Application/Subcenefcos/DTOs/SubcenefcoPublicDTO.php
app/Application/BannersPortal/DTOs/BannerPortalPublicDTO.php
app/Application/DocumentosTransparencia/DTOs/DocumentoPublicDTO.php
app/Application/AudienciasPublicas/DTOs/AudienciaPublicaPublicDTO.php
```

**QueryHandlers a modificar** (agregar bifurcación `if ($query->soloActivos)`):

```text
app/Application/NominaPersonal/QueryHandlers/GetNominaPersonalQueryHandler.php
app/Application/PreguntasFrecuentes/QueryHandlers/GetPreguntasFrecuentesQueryHandler.php
app/Application/Noticias/QueryHandlers/GetNoticiasQueryHandler.php
app/Application/Noticias/QueryHandlers/GetNoticiaBySlugQueryHandler.php
app/Application/Comunicados/QueryHandlers/GetComunicadosQueryHandler.php
app/Application/Comunicados/QueryHandlers/GetComunicadoBySlugQueryHandler.php
app/Application/Eventos/QueryHandlers/GetEventosQueryHandler.php
app/Application/Eventos/QueryHandlers/GetEventoByIdQueryHandler.php
app/Application/Autoridades/QueryHandlers/GetAutoridadesQueryHandler.php
app/Application/Secretarias/QueryHandlers/GetSecretariasQueryHandler.php
app/Application/Subcenefcos/QueryHandlers/GetSubcenefcosQueryHandler.php
app/Application/BannersPortal/QueryHandlers/GetBannersPortalQueryHandler.php
app/Application/DocumentosTransparencia/QueryHandlers/GetDocumentosQueryHandler.php
app/Application/AudienciasPublicas/QueryHandlers/GetAudienciasPublicasQueryHandler.php
```

---

### Tabla resumen de severidad por fase

| Hallazgo | Severidad | Estado |
|---|---|---|
| `ci` expuesto en `/portal/nomina-personal` | 🔴 Crítico | Pendiente |
| `usuario_id` expuesto en `/portal/nomina-personal` | 🔴 Crítico | Pendiente |
| `autor_id` expuesto en `/portal/noticias` | 🟠 Alto | Pendiente |
| `nivel_salarial` expuesto en `/portal/nomina-personal` | 🟠 Alto | Pendiente |
| `creado_por` expuesto en `/portal/eventos` | 🟠 Alto | Pendiente |
| IDs secuenciales en listados del portal | 🟠 Alto | Pendiente |
| `activo`/`estado` interno en respuestas públicas | 🟡 Medio | Pendiente |
| `created_at` en respuestas públicas | 🟡 Medio | Pendiente |
| FKs numéricas (`categoria_id`, `secretaria_id`, etc.) | 🟡 Medio | Pendiente |

---

---

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
