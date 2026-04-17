# Changelog — cenefco

Todos los cambios notables del proyecto se documentan aquí.

Formato basado en [Keep a Changelog](https://keepachangelog.com/es-ES/1.0.0/).
Versiones siguiendo [Semantic Versioning](https://semver.org/lang/es/).

---

## [Unreleased]

Cambios en desarrollo que aún no tienen versión asignada.

---

## [0.2.0] — 2026-04-14

### Agregado

- 145 migraciones Laravel generadas a partir del esquema legado SIASEC (`disereco_siasec_backup.sql`)
- Cobertura completa de tablas: usuarios, niveles, grupos de permisos, materias, planes, inscripciones, notas, horarios, pagos, documentos, programas, catálogos, contenido web y sus espejos `_log`
- Nomenclatura unificada: archivos con prefijo `cenefco_` en el nombre, tablas con nombres originales (`t_`, `mdl_`)
- CLAUDE.md y README.md actualizados con contexto completo del esquema legado
- Sección "Base de datos cenefco" en CLAUDE.md con convenciones, grupos de tablas y relaciones clave

### Convenciones aplicadas en migraciones legado

- Sin `timestamps()` — las tablas usan `fecha_reg` propio
- Sin `softDeletes()` — baja lógica mediante columna `estado tinyint`
- PKs compuestas via `$table->primary([...])`
- `id_us_reg` como campo de auditoría en todas las tablas principales

---

## [0.1.0] — 2026-04-01

### Agregado

- Estructura base DDD + CQRS con capas Domain / Application / Infrastructure / Http
- Módulo de Usuarios y Roles: CRUD completo con niveles y permisos granulares
- Autenticación con Laravel Sanctum (login, logout)
- Middleware `permiso:recurso.accion` para control de acceso granular
- `DomainServiceProvider` con binding de interfaces → repositorios Eloquent
- DTOs inmutables (`final readonly class`) con factory `fromModel()`
- `PaginationDTO` para paginación uniforme en todos los listados
- `GeneralSettings` con `spatie/laravel-settings` para configuración del sistema
- Generación de documentos PDF con DomPDF
- Documentación OpenAPI con `darkaonline/l5-swagger`
- Makefile con comandos de desarrollo, BD, caché y calidad de código
- README y CLAUDE.md con arquitectura, patrones y guía de onboarding
