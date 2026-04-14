# Arquitectura DDD - Explicación

Este documento explica qué es DDD y cómo organizar el backend del proyecto siguiendo esa arquitectura.

## 1. ¿Qué es DDD?

DDD (Domain-Driven Design) es una forma de diseñar software centrada en el dominio del negocio. La idea central es mantener el código alineado con el lenguaje y las reglas de negocio.

En DDD hay dos conceptos clave:
- `Dominio`: lo que hace el negocio.
- `Infraestructura`: cómo se guarda o se comunica el sistema.

## 2. Capas principales en DDD

### 2.1 Domain

Es el núcleo del sistema.

Contiene:
- Entidades.
- Value Objects.
- Interfaces / contratos.
- Reglas e invariantes del negocio.
- Lógicas puras del dominio.

Aquí no debe haber dependencias directas a frameworks o bases de datos.

### 2.2 Application

Esta capa orquesta el uso del dominio.

Contiene:
- Servicios de aplicación.
- Casos de uso.
- Comandos y handlers.
- Coordinación de operaciones.

El `Application` habla con `Domain` y con `Infrastructure`, pero no implementa persistencia directamente.

### 2.3 Infrastructure

Implementa detalles técnicos.

Contiene:
- Repositorios concretos.
- Modelos Eloquent u ORM.
- Conexiones a bases de datos.
- Adaptadores externos (APIs, storages, colas, etc.).

### 2.4 Interface / Presentation / Http

Es la entrada al sistema.

Contiene:
- Controladores.
- Requests / validaciones.
- Formatos de respuesta.
- Rutas.

Solo debe recibir peticiones, validar y llamar a la capa de `Application`.

## 3. Flujo recomendado al empezar

1. Primero define el `Domain`:
   - ¿Qué entidades hay?
   - ¿Qué reglas son importantes?
   - ¿Qué operaciones necesita el negocio?
2. Crea los contratos de repositorio en `Domain`.
3. Implementa la persistencia en `Infrastructure`.
4. Crea un servicio de `Application` que use los contratos de `Domain`.
5. Expón la funcionalidad desde `Http`.

## 4. Ejemplo de capas

### Domain
- `app/Domain/Usuarios/Contracts/RoleRepositoryInterface.php`
- `app/Domain/Clientes/Contracts/ClienteRepositoryInterface.php`

### Infrastructure
- `app/Infrastructure/Usuarios/Models/Role.php`
- `app/Infrastructure/Usuarios/Repositories/EloquentRoleRepository.php`

### Application
- `app/Application/Usuarios/Services/RoleService.php`

### Http
- `app/Http/Controllers/Api/RoleController.php`

## 5. Dónde comienza en este repo

Empieza en `app/Domain`.

- Modela los conceptos de negocio.
- Crea interfaces para cada recurso.
- Deja fuera cualquier detalle de base de datos.

Luego ve a `app/Application`:

- Define qué hace cada caso de uso.
- Agrupa validaciones y normalización de datos.

Después a `app/Infrastructure`:

- Implementa los repositorios.
- Crea los modelos.
- Añade los bindings en `app/Providers/DomainServiceProvider.php`.

Finalmente en `app/Http/Controllers`:

- Crea los endpoints.
- Valida requests.
- Llama al servicio de aplicación.

## 6. Principios clave

- `Domain` es el corazón: aquí vive la lógica de negocio.
- `Application` orquesta, no implementa detalles.
- `Infrastructure` adapta el mundo externo al dominio.
- `Http` es solo la puerta de entrada.

## 7. Beneficios de DDD

- Código más fácil de mantener.
- Separación clara entre negocio y tecnología.
- Cambios en la persistencia no afectan el dominio.
- Permite probar el negocio sin un framework.

## 8. Resumen rápido

- Si vas a construir algo nuevo: piensa primero en el dominio.
- Usa `Domain` para vocabulario y reglas.
- Usa `Infrastructure` solo para detalles técnicos.
- Deja `Http` limpio y simple.
- Añade `Application` cuando el flujo necesite coordinación.
