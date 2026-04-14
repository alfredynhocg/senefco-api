# Mockups de Pantallas — Portal Web Institucional Alcaldía Municipal

**Versión:** 1.0 | **Gestión:** 2026

> Representación visual de la arquitectura de pantallas del portal.
> Basado en el modelo real del GAMEA (Gobierno Autónomo Municipal de El Alto).
> Nomenclatura: `[BTN]` = botón · `[IMG]` = imagen · `[ICO]` = ícono · `[↓]` = desplegable · `[ ]` = campo de texto

---

## Estructura de Navegación

```text
Inicio
Institucional ▾       → Misión/Visión/Valores · Autoridad Municipal · POA · PEI · Auditorías · Transparencia
Servicios ▾           → Atención Ciudadana · Gaceta Municipal · Seguimiento Trámites · Secretarías · Subalcaldías
Comunicación ▾        → Noticias · Galería · Historia · Himno · Revistas y Cartillas
Normativa             → Gaceta (repositorio de normas)
Recursos Humanos ▾    → Organigrama · Nómina y Autoridades · Manual MOF · Manual MPP · Escala Salarial
Información Financiera
Contacto
```

---

## Índice de Pantallas

| # | Pantalla | Descripción |
|---|----------|-------------|
| 1 | [Header Global](#1-header-global) | 2 filas: identidad y búsqueda arriba, navegación abajo |
| 2 | [Footer Global](#2-footer-global) | Pie de página fijo en todas las páginas |
| 3 | [Inicio (Home)](#3-inicio-home) | Página principal del portal |
| 4 | [Institucional — Autoridad Municipal](#4-institucional--autoridad-municipal) | Alcalde/sa y concejales |
| 5 | [Institucional — Organigrama](#5-institucional--organigrama) | Estructura orgánica interactiva |
| 6 | [Recursos Humanos — Manuales y Escala Salarial](#6-recursos-humanos--manuales-y-escala-salarial) | MOF, MPP, Escala Salarial, Nómina |
| 7 | [Servicios — Catálogo de Trámites](#7-servicios--catálogo-de-trámites) | Listado y búsqueda de trámites |
| 8 | [Servicios — Detalle de Trámite](#8-servicios--detalle-de-trámite) | Ficha completa de un trámite |
| 9 | [Comunicación — Noticias](#9-comunicación--noticias) | Archivo de noticias con filtros |
| 10 | [Comunicación — Historia e Himno](#10-comunicación--historia-e-himno) | Páginas de identidad municipal |
| 11 | [Normativa — Gaceta Municipal](#11-normativa--gaceta-municipal) | Repositorio de normas y gaceta oficial |
| 12 | [Transparencia — Auditorías](#12-transparencia--auditorías) | Informes de auditoría interna y externa |
| 13 | [Transparencia — Dashboard de Gestión](#13-transparencia--dashboard-de-gestión) | Panel de indicadores de gobierno abierto |
| 14 | [Información Financiera](#14-información-financiera) | POA, PEI, Presupuesto, Ejecución presupuestaria |
| 15 | [Gobierno Electrónico — Portal Ciudadano](#15-gobierno-electrónico--portal-ciudadano) | Panel personal del ciudadano |
| 16 | [Contacto y Directorio](#16-contacto-y-directorio) | Formulario y mapa de ubicaciones |
| 17 | [Login — Registro Ciudadano](#17-login--registro-ciudadano) | Autenticación de usuarios |
| 18 | [Versión Móvil — Home](#18-versión-móvil--home) | Adaptación responsive del inicio |

---

## 1. Header Global

> Estructura en **dos filas**. Fijo en todas las páginas. Responsivo con menú hamburguesa en tablet/móvil.

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│  FILA 1 — Identidad institucional                                                       │
│                                                                                         │
│  [IMG logo blanco]  SIGLA MUNICIPIO                  [🔍 Buscar aquí...]   [IMG escudo] │
│                     Gobierno Autónomo Municipal                             Bolivia      │
│                     de Achocalla                                                        │
└─────────────────────────────────────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│  FILA 2 — Barra de navegación principal (fondo color primario)                         │
│                                                                                         │
│  Inicio │ Institucional [▾] │ Servicios [▾] │ Comunicación [▾] │ Normativa │            │
│         │ Rec. Humanos [▾]  │ Inf. Financiera │ Contacto                               │
└─────────────────────────────────────────────────────────────────────────────────────────┘

── Submenú "Institucional" ──────────────────────────────────────────
│  Misión, Visión y Valores        │  Autoridad Municipal            │
│  Plan Operativo Anual (POA)      │  Plan Estratégico Inst. (PEI)   │
│  Auditorías                      │  Transparencia                  │
──────────────────────────────────────────────────────────────────────

── Submenú "Servicios" ──────────────────────────────────────────────
│  Atención Ciudadana [↗]          │  Gaceta Municipal [↗]           │
│  Seguimiento de Trámites [↗]     │  Secretarías                    │
│  Subalcaldías                    │                                  │
──────────────────────────────────────────────────────────────────────

── Submenú "Comunicación" ───────────────────────────────────────────
│  Noticias                        │  Galería                        │
│  Historia                        │  Himno Municipal                │
│  Revistas y Cartillas            │                                  │
──────────────────────────────────────────────────────────────────────

── Submenú "Recursos Humanos" ───────────────────────────────────────
│  Organigrama                     │  Nómina de Personal             │
│  Manual de Org. y Funciones      │  Manual de Procesos             │
│  Escala Salarial                 │                                  │
──────────────────────────────────────────────────────────────────────

── Header en Tablet/Móvil ───────────────────────────────────────────
│  [IMG logo color]                         ☰  [BTN menú]           │
│  Gobierno Autónomo Municipal de Achocalla                          │
──────────────────────────────────────────────────────────────────────
```

---

## 2. Footer Global

> Pie de página presente en **todas las páginas**.

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  [IMG escudo pequeño]              NAVEGACIÓN RÁPIDA          CONTÁCTENOS              │
│  Gobierno Autónomo Municipal       Inicio                     📍 Av. Principal s/n      │
│  de Achocalla                      Noticias                   📞 (591-2) 000-0000       │
│  "Juntos construimos Achocalla"    Seguimiento Trámites       ✉  senefco@achocalla.bo  │
│                                    Transparencia              ⏰  Lun–Vie 8:00–16:00    │
│  REDES SOCIALES OFICIALES          Normativa / Gaceta                                   │
│  [f] [𝕏] [📷] [▶] [💬]            Contacto                                            │
│                                                                                         │
│  ─────────────────────────────────────────────────────────────────────────────────────  │
│  © 2026 Alcaldía Municipal de Achocalla · Política de Privacidad · Aviso Legal         │
│  Portal desarrollado con WordPress + Elementor — Todos los derechos reservados         │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 3. Inicio (Home)

### 3.1 Hero — Slideshow Fullscreen con Ken Burns

> Fondo de pantalla completa con slideshow automático (4–5 imágenes, efecto Ken Burns).
> Un card pequeño superpuesto muestra el logo/aniversario o campaña vigente.

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│   [IMAGEN FONDO FULLSCREEN — 100vw × 520px, efecto Ken Burns, transición suave]        │
│                                                                                         │
│   ┌──────────────────────────────────────┐                                             │
│   │  [IMG logo aniversario / campaña]    │                                             │
│   │  "XX Años al servicio del municipio" │                                             │
│   │                                      │                                             │
│   │  [BTN  Ver galería  →]               │                                             │
│   └──────────────────────────────────────┘                                             │
│                                                                                         │
│   ○  ●  ○  ○  ○          (indicadores de slide, sin controles visibles)               │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

### 3.2 Accesos Rápidos a Servicios

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│                    ¿QUÉ NECESITÁS HOY?                                                 │
│                                                                                         │
│  ┌──────────────────────────┐  ┌──────────────────────────┐  ┌────────────────────┐   │
│  │   📋                     │  │   👨‍👩‍👧                    │  │   🏛              │   │
│  │  TRÁMITES                │  │  SERVICIOS               │  │  NORMATIVA         │   │
│  │  MUNICIPALES             │  │  SOCIALES                │  │  GACETA MUNICIPAL  │   │
│  │                          │  │                          │  │                    │   │
│  │  Licencias · Catastro    │  │  Defensoría · Asistencia │  │  Leyes · Decretos  │   │
│  │  Negocios · Permisos     │  │  Permisos viaje menores  │  │  Resoluciones      │   │
│  │                          │  │                          │  │                    │   │
│  │  [BTN Ver catálogo →]    │  │  [BTN Ver servicios →]   │  │  [BTN Ver gaceta →]│   │
│  └──────────────────────────┘  └──────────────────────────┘  └────────────────────┘   │
│                                                                                         │
│  ┌──────────────────────────┐  ┌──────────────────────────┐                            │
│  │   📞                     │  │   🏗                     │                            │
│  │  ATENCIÓN                │  │  INFORMACIÓN             │                            │
│  │  CIUDADANA               │  │  FINANCIERA              │                            │
│  │                          │  │                          │                            │
│  │  Consultas · Denuncias   │  │  POA · PEI · Presupuesto │                            │
│  │  Sugerencias             │  │  Ejecución               │                            │
│  │                          │  │                          │                            │
│  │  [BTN Ir al portal →]    │  │  [BTN Ver más →]         │                            │
│  └──────────────────────────┘  └──────────────────────────┘                            │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

### 3.3 Noticias Destacadas

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  ÚLTIMAS NOTICIAS                                    [BTN  Ver todas las noticias →]    │
│  ───────────────────────────────────────────────────────────────────────────────────    │
│                                                                                         │
│  ┌───────────────────────────┐  ┌───────────────────────────┐  ┌───────────────────┐   │
│  │  [IMG 400x220]            │  │  [IMG 400x220]            │  │  [IMG 400x220]    │   │
│  │  📅 15 mar 2026  🏷 Obras │  │  📅 12 mar 2026  🏷 Social│  │  📅 10 mar 2026   │   │
│  │                           │  │                           │  │  🏷 Cultura       │   │
│  │  Alcaldía inaugura        │  │  Más de 300 familias      │  │                   │   │
│  │  pavimentación de la      │  │  beneficiadas con el      │  │  Festival cultural│   │
│  │  Av. Los Álamos           │  │  programa social          │  │  reúne artistas   │   │
│  │                           │  │                           │  │  de todo el país  │   │
│  │  La obra beneficiará...   │  │  El programa entregó...   │  │  El evento será...│   │
│  │                           │  │                           │  │                   │   │
│  │  [BTN Leer más →]         │  │  [BTN Leer más →]         │  │  [BTN Leer más →] │   │
│  └───────────────────────────┘  └───────────────────────────┘  └───────────────────┘   │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

### 3.4 Dashboard — Gestión en Números

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  GESTIÓN EN NÚMEROS — Actualizado: marzo 2026        [BTN Ver transparencia completa →] │
│  ───────────────────────────────────────────────────────────────────────────────────    │
│                                                                                         │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐  ┌──────────┐  │
│  │  💰  68%     │  │  🏗️  47      │  │  🎓  82      │  │  🏥  12      │  │  📋 1.430│  │
│  │  Presupuesto │  │  Obras en    │  │  Unidades    │  │  Centros de  │  │  Trámites│  │
│  │  ejecutado   │  │  ejecución   │  │  educativas  │  │  salud       │  │  este mes│  │
│  └──────────────┘  └──────────────┘  └──────────────┘  └──────────────┘  └──────────┘  │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

### 3.5 Agenda Institucional

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│   PRÓXIMOS EVENTOS                                         [BTN Ver agenda completa →]  │
│   ─────────────────────────────────────────────────────────────────────────────────    │
│                                                                                         │
│   📅 28 MAR  Rendición de cuentas media — Sala Municipal       [BTN + Info]            │
│   📅 02 ABR  Reunión Concejo Municipal — Sesión ordinaria Nº 14[BTN + Info]            │
│   📅 15 ABR  Audiencia Pública — Presupuesto participativo     [BTN + Info]            │
│   📅 20 ABR  Acto cívico — Aniversario del Municipio           [BTN + Info]            │
│                                                                                         │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 4. Institucional — Autoridad Municipal

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Institucional  >  Autoridad Municipal                                                 │
│  ═══════════════════════════════════════                                                │
│                                                                                         │
│  ┌─────────────────────────────────────────────────────────────────────────────────┐   │
│  │                       ALCALDE/SA MUNICIPAL                                      │   │
│  │                                                                                 │   │
│  │         ┌──────────────┐                                                        │   │
│  │         │              │   NOMBRE COMPLETO APELLIDO                            │   │
│  │         │  [IMG foto   │   Alcalde/sa Municipal — Gestión 2025–2030            │   │
│  │         │   oficial    │   ─────────────────────────────────────────────────   │   │
│  │         │  200x220px]  │   Formación académica y trayectoria profesional.      │   │
│  │         │              │   Objetivos y compromisos de gestión municipal.       │   │
│  │         └──────────────┘                                                        │   │
│  │                            ✉  alcalde@achocalla.gob.bo                        │   │
│  └─────────────────────────────────────────────────────────────────────────────────┘   │
│                                                                                         │
│  CONCEJO MUNICIPAL                                                                      │
│  ─────────────────────────────────────────────────────────────────────────────────────  │
│                                                                                         │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐               │
│  │ [IMG 150x160]│  │ [IMG 150x160]│  │ [IMG 150x160]│  │ [IMG 150x160]│               │
│  │ Nombre       │  │ Nombre       │  │ Nombre       │  │ Nombre       │               │
│  │ Apellido     │  │ Apellido     │  │ Apellido     │  │ Apellido     │               │
│  │ Concejal/a   │  │ Concejal/a   │  │ Concejal/a   │  │ Concejal/a   │               │
│  │ ✉ email...  │  │ ✉ email...  │  │ ✉ email...  │  │ ✉ email...  │               │
│  └──────────────┘  └──────────────┘  └──────────────┘  └──────────────┘               │
│                                                                                         │
│  SECRETARIOS/AS MUNICIPALES                                                             │
│  ─────────────────────────────────────────────────────────────────────────────────────  │
│                                                                                         │
│  ┌──────────────────────────────────┐  ┌──────────────────────────────────┐            │
│  │  [IMG]  Nombre Apellido          │  │  [IMG]  Nombre Apellido          │            │
│  │  Sec. de Planificación           │  │  Sec. de Adm. y Finanzas         │            │
│  │  ✉ planificacion@achocalla.bo   │  │  ✉ finanzas@achocalla.bo        │            │
│  │  [BTN Ver perfil]                │  │  [BTN Ver perfil]                │            │
│  └──────────────────────────────────┘  └──────────────────────────────────┘            │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 5. Institucional — Organigrama

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Institucional  >  Organigrama Institucional                [BTN ⬇ Descargar PDF]      │
│  ═══════════════════════════════════════════════════════════════                        │
│  Actualizado: enero 2026                                    [BTN 🔍 Ampliar]           │
│                                                                                         │
│                        ┌─────────────────────┐                                         │
│                        │   ALCALDE MUNICIPAL  │                                         │
│                        └──────────┬──────────┘                                         │
│                                   │                                                     │
│           ┌───────────────────────┼────────────────────────┐                           │
│           │                       │                        │                           │
│  ┌────────┴───────┐    ┌──────────┴───────┐    ┌──────────┴───────┐                   │
│  │  SECRETARÍA    │    │  SECRETARÍA ADM. │    │  SECRETARÍA INF. │                   │
│  │  PLANIFICACIÓN │    │  Y FINANZAS      │    │  PÚBLICA         │                   │
│  └────────┬───────┘    └──────────┬───────┘    └──────────┬───────┘                   │
│           │                       │                        │                           │
│    ┌──────┴──────┐         ┌──────┴──────┐         ┌──────┴──────┐                    │
│    │ Unidad POA  │         │  Tesorería  │         │ Dir. Obras  │                    │
│    │ y Presup.   │         │  Municipal  │         │ Públicas    │                    │
│    └─────────────┘         └─────────────┘         └─────────────┘                    │
│                                                                                         │
│  ── Tooltip al pasar el cursor sobre cada caja ─────────────────────────────────────── │
│  │  👤 Nombre del titular actual   📞 Teléfono   ✉ Email institucional              │  │
│  ─────────────────────────────────────────────────────────────────────────────────────  │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 6. Recursos Humanos — Manuales y Escala Salarial

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Recursos Humanos  >  Documentos Institucionales                                       │
│  ═══════════════════════════════════════════════                                        │
│                                                                                         │
│  ── NÓMINA DE PERSONAL Y AUTORIDADES ───────────────────────────────────────────────    │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  Gestión: [2026 ↓]         Unidad: [Todas ↓]       [BTN ⬇ Descargar XLSX]       │  │
│  │                                                                                  │  │
│  │  Nombre             Cargo                    Unidad              Nivel Salarial  │  │
│  │  ────────────────   ─────────────────────    ─────────────────   ──────────────  │  │
│  │  Nombre Apellido    Alcalde/sa Municipal      Ej. Municipal       Nivel A        │  │
│  │  Nombre Apellido    Sec. de Planificación     Planificación       Nivel B        │  │
│  │  ...                ...                       ...                 ...            │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
│                                                                                         │
│  ── ESCALA SALARIAL ─────────────────────────────────────────────────────────────────   │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  📄 Escala Salarial Gestión 2026.pdf                      [BTN ⬇ Descargar]     │  │
│  │  📄 Escala Salarial Gestión 2025.pdf                      [BTN ⬇ Descargar]     │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
│                                                                                         │
│  ── MANUALES INSTITUCIONALES ────────────────────────────────────────────────────────   │
│                                                                                         │
│  ┌──────────────────────────────────────────┐  ┌──────────────────────────────────┐   │
│  │  📘 Manual de Organización y Funciones   │  │  📗 Manual de Procesos y         │   │
│  │     (MOF)                                │  │     Procedimientos (MPP)         │   │
│  │                                          │  │                                  │   │
│  │  Describe la estructura orgánica,        │  │  Define los procedimientos       │   │
│  │  funciones y atribuciones de cada        │  │  administrativos, flujos de      │   │
│  │  unidad del gobierno municipal.          │  │  trabajo y responsables.         │   │
│  │                                          │  │                                  │   │
│  │  Versión 2026  |  PDF  |  142 págs.      │  │  Versión 2026  |  PDF  |  98 págs│   │
│  │  [BTN ⬇ Descargar]  [BTN 👁 Ver en línea]│  │  [BTN ⬇ Descargar]  [BTN 👁 Ver]│   │
│  └──────────────────────────────────────────┘  └──────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 7. Servicios — Catálogo de Trámites

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Servicios  >  Catálogo de Trámites                                                   │
│  ══════════════════════════════════                                                     │
│                                                                                         │
│  ┌─────────────────────────────────────────────────────────────────┐                   │
│  │  🔍  Buscar trámite...                            [BTN Buscar]  │                   │
│  └─────────────────────────────────────────────────────────────────┘                   │
│                                                                                         │
│  Categoría: [Todos ✓] [Impuestos] [Catastro] [Negocios] [Social] [Ambiental]           │
│  Modalidad: [Todos ✓] [Presencial] [En línea] [Mixto]                                  │
│                                                                                         │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  🏠 IMPUESTOS MUNICIPALES                              3 trámites               │  │
│  │  ─────────────────────────────────────────────────────────────────────────────   │  │
│  │  ┌──────────────────────────────┐  Pago de Impuesto a Inmuebles (IMBI)          │  │
│  │  │ 🟢 EN LÍNEA  ⏱ 1 día hábil  │  Pago del impuesto anual sobre bienes         │  │
│  │  │ Unidad: Adm. Tributaria Mun. │  inmuebles del municipio.                     │  │
│  │  │ Costo: Según declaración     │                       [BTN Ver requisitos →]  │  │
│  │  └──────────────────────────────┘                                               │  │
│  │  ─────────────────────────────────────────────────────────────────────────────   │  │
│  │  ┌──────────────────────────────┐  Pago de Impuesto a Vehículos (IMT)           │  │
│  │  │ 🟢 EN LÍNEA  ⏱ 1 día hábil  │  Impuesto municipal anual para                │  │
│  │  │ Unidad: Adm. Tributaria Mun. │  vehículos automotores registrados.           │  │
│  │  │ Costo: Según modelo y año    │                       [BTN Ver requisitos →]  │  │
│  │  └──────────────────────────────┘                                               │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
│                                                                                         │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  🗺️ CATASTRO Y TERRITORIO                             5 trámites               │  │
│  │  ...                                                                             │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 8. Servicios — Detalle de Trámite

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Servicios  >  Impuestos  >  Pago de Impuesto a Inmuebles (IMBI)                      │
│  ══════════════════════════════════════════════════════════════                         │
│                                                                                         │
│  ┌──────────────────────────────────────────────────┐  ┌──────────────────────────┐   │
│  │                                                  │  │  DATOS DEL TRÁMITE       │   │
│  │  PAGO DE IMPUESTO A INMUEBLES (IMBI)             │  │  ─────────────────────   │   │
│  │  ─────────────────────────────────────────────   │  │  🟢 Disponible en línea  │   │
│  │                                                  │  │  ⏱  1 día hábil          │   │
│  │  Descripción                                     │  │  💰  Según DJ             │   │
│  │  Pago del impuesto municipal anual que           │  │  📍  Adm. Tributaria Mun. │   │
│  │  grava los bienes inmuebles ubicados             │  │                          │   │
│  │  dentro del territorio del municipio.            │  │  Sustento legal:         │   │
│  │                                                  │  │  Ley 154 · DS Nº 27190   │   │
│  │  REQUISITOS                                      │  │                          │   │
│  │  ─────────────────────────────────────────────   │  │  [BTN Iniciar trámite    │   │
│  │  ☑  1. Fotocopia CI del propietario              │  │      en línea  🖥️]       │   │
│  │  ☑  2. Código catastral del inmueble             │  │                          │   │
│  │  ☑  3. Último recibo de pago (si aplica)         │  │  [BTN Descargar          │   │
│  │  ☑  4. Formulario IMBI-01 (descargable)          │  │      formulario  ⬇️]     │   │
│  │                                                  │  │                          │   │
│  │  PROCEDIMIENTO                                   │  │  ¿Necesitás ayuda?       │   │
│  │  ─────────────────────────────────────────────   │  │  📞 (591-2) 000-0010     │   │
│  │  1. Obtener código catastral del inmueble        │  │  ✉ atm@achocalla.bo     │   │
│  │  2. Ingresar al portal o acudir a la ATM         │  └──────────────────────────┘   │
│  │  3. Declarar el valor del inmueble               │                                  │
│  │  4. Realizar el pago y descargar comprobante     │                                  │
│  │                                                  │                                  │
│  │  FORMULARIOS DESCARGABLES                        │                                  │
│  │  ─────────────────────────────────────────────   │                                  │
│  │  📄 Formulario IMBI-01.pdf   [⬇ Descargar]      │                                  │
│  │  📄 Guía de llenado.pdf      [⬇ Descargar]      │                                  │
│  └──────────────────────────────────────────────────┘                                  │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 9. Comunicación — Noticias

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Comunicación  >  Noticias Institucionales                                             │
│  ═════════════════════════════════════════                                              │
│                                                                                         │
│  🔍  Buscar noticias...                                             [BTN Buscar]        │
│  Categorías: [Todas ✓] [Obras] [Social] [Cultura] [Salud] [Medio Ambiente] [Seguridad] │
│                                                                                         │
│  ┌────────────────────────────────────────────────────────────┐  ┌──────────────────┐  │
│  │  ┌──────────┐  ALCALDÍA INAUGURA SISTEMA DE RIEGO         │  │  MÁS LEÍDAS      │  │
│  │  │[IMG 120  │  🏷 Obras   📅 20 mar 2026                  │  │  ──────────────   │  │
│  │  │  x 80]   │  La Alcaldía Municipal en coordinación...   │  │  1. Título noticia│  │
│  │  └──────────┘                              [Leer más →]   │  │  2. Título noticia│  │
│  │  ──────────────────────────────────────────────────────    │  │  3. Título noticia│  │
│  │  ┌──────────┐  NUEVA RESOLUCIÓN MEJORA ATENCIÓN            │  │                  │  │
│  │  │[IMG 120  │  EN DEFENSORÍA DE LA NIÑEZ                  │  │  ETIQUETAS       │  │
│  │  │  x 80]   │  🏷 Social   📅 17 mar 2026                 │  │  ──────────────   │  │
│  │  └──────────┘                              [Leer más →]   │  │  [obras] [social] │  │
│  │  ──────────────────────────────────────────────────────    │  │  [cultura] [agua] │  │
│  │  ┌──────────┐  FESTIVAL INTERCULTURAL REUNIRÁ              │  │                  │  │
│  │  │[IMG 120  │  COMUNIDADES DEL MUNICIPIO                  │  │  ARCHIVO         │  │
│  │  │  x 80]   │  🏷 Cultura   📅 15 mar 2026               │  │  ──────────────   │  │
│  │  └──────────┘                              [Leer más →]   │  │  Marzo 2026 (12) │  │
│  │                                                            │  │  Febrero 2026(9) │  │
│  │       [❮ Anterior]   Página 1 de 8   [Siguiente ❯]       │  │  Enero 2026 (11) │  │
│  └────────────────────────────────────────────────────────────┘  └──────────────────┘  │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 10. Comunicación — Historia e Himno

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Comunicación  >  Historia del Municipio                                               │
│  ═══════════════════════════════════════                                                │
│                                                                                         │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  [IMG panorámica histórica del municipio — 1200x400px]                           │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
│                                                                                         │
│  ┌────────────────────────────────────────────────────────┐  ┌──────────────────────┐  │
│  │                                                        │  │  LÍNEA DE TIEMPO     │  │
│  │  RESEÑA HISTÓRICA                                      │  │  ──────────────────  │  │
│  │  ──────────────────────────────────────────────────    │  │  1548  Fundación     │  │
│  │  El municipio de Achocalla tiene sus raíces en         │  │  │                   │  │
│  │  las comunidades originarias que habitaron...          │  │  1825  Independencia │  │
│  │                                                        │  │  │                   │  │
│  │  [Sección por épocas: colonial, republicana,           │  │  1994  Municipio     │  │
│  │   contemporánea, autonomías]                           │  │  │     autónomo      │  │
│  │                                                        │  │  2010  Autonomía     │  │
│  │  GALERÍA HISTÓRICA                                     │  │  │     ampliada      │  │
│  │  ──────────────────────────────────────────────────    │  │  2026  Gestión      │  │
│  │  [IMG] [IMG] [IMG] [IMG]    [Ver galería completa →]   │  │        vigente      │  │
│  └────────────────────────────────────────────────────────┘  └──────────────────────┘  │
│                                                                                         │
│  ── HIMNO MUNICIPAL ────────────────────────────────────────────────────────────────    │
│                                                                                         │
│  ┌────────────────────────────────────────────────────────────────────────────────┐    │
│  │  [▶ BTN Reproducir himno]                [BTN ⬇ Descargar audio MP3]          │    │
│  │                                                                                │    │
│  │   ┌──────────────────────────────────────────────────────────────────────┐    │    │
│  │   │ LETRA DEL HIMNO MUNICIPAL DE ACHOCALLA                               │    │    │
│  │   │ ─────────────────────────────────────                                │    │    │
│  │   │ Verso I:                                                              │    │    │
│  │   │ [Texto de la letra del himno municipal...]                           │    │    │
│  │   │                                                                      │    │    │
│  │   │ Coro:                                                                │    │    │
│  │   │ [Texto del coro...]                                                  │    │    │
│  │   └──────────────────────────────────────────────────────────────────────┘    │    │
│  └────────────────────────────────────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 11. Normativa — Gaceta Municipal

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Normativa  >  Gaceta Municipal                                                       │
│  ══════════════════════════════                                                         │
│                                                                                         │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  🔍  Buscar por número, título o palabras clave...                               │  │
│  │  Tipo: [Todos ✓] [Ley Municipal] [Decreto] [Resolución] [Reglamento]            │  │
│  │  Año:  [2026 ↓]     Estado: [Vigente ✓] [Derogado] [Modificado]                │  │
│  │                                                         [BTN Buscar]            │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
│                                                                                         │
│  ── ÚLTIMAS PUBLICACIONES EN GACETA ─────────────────────────────────────────────────   │
│                                                                                         │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  📜 LEY MUNICIPAL Nº 042/2026                                    🟢 VIGENTE      │  │
│  │  Ley de Gestión Integral de Residuos Sólidos del Municipio                      │  │
│  │  Promulgada: 15 feb 2026  |  Tema: Medio Ambiente                               │  │
│  │  Gaceta Municipal Nº 031                    [BTN 👁 Ver]  [BTN ⬇ PDF]          │  │
│  │  ────────────────────────────────────────────────────────────────────────────    │  │
│  │  📜 DECRETO MUNICIPAL Nº 018/2026                                🟢 VIGENTE      │  │
│  │  Reglamento de Licencias de Funcionamiento para Establecimientos Comerciales    │  │
│  │  Promulgado: 03 ene 2026  |  Tema: Negocios y Comercio                          │  │
│  │  Gaceta Municipal Nº 028                    [BTN 👁 Ver]  [BTN ⬇ PDF]          │  │
│  │  ────────────────────────────────────────────────────────────────────────────    │  │
│  │  📜 RESOLUCIÓN EJECUTIVA Nº 211/2025                             🟡 MODIFICADO   │  │
│  │  Aprobación del Plan Operativo Anual Gestión 2026                               │  │
│  │  Promulgada: 28 nov 2025  |  Tema: Planificación                                │  │
│  │  Gaceta Municipal Nº 024                    [BTN 👁 Ver]  [BTN ⬇ PDF]          │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
│                                                                                         │
│       [❮ Anterior]   Página 1 de 3   [Siguiente ❯]                                    │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 12. Transparencia — Auditorías

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Institucional  >  Transparencia  >  Auditorías                                       │
│  ══════════════════════════════════════════════                                         │
│                                                                                         │
│  Tipo: [Todas ✓] [Auditoría Interna] [Auditoría Externa] [Auditoría Especial]          │
│  Año:  [2026 ↓]    Estado: [Todos ✓] [En proceso] [Concluida]                         │
│                                                                                         │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  🔍 AUDITORÍA INTERNA — AI-2025-004                              ✅ CONCLUIDA    │  │
│  │  Examen Especial a las Cuentas de la Secretaría de Administración               │  │
│  │  Gestión: 2025  |  Unidad Auditora: Unidad de Auditoría Interna                 │  │
│  │  Periodo auditado: Ene–Dic 2025  |  Fecha informe: 15 feb 2026                  │  │
│  │                                                    [BTN ⬇ Descargar Informe]   │  │
│  │  ────────────────────────────────────────────────────────────────────────────    │  │
│  │  🔍 AUDITORÍA EXTERNA — AE-2025-001                              ✅ CONCLUIDA   │  │
│  │  Auditoría Financiera a los Estados Financieros del GAM                         │  │
│  │  Gestión: 2025  |  Firma auditora: Contraloría General del Estado               │  │
│  │  Periodo auditado: Ene–Dic 2025  |  Fecha informe: 20 mar 2026                  │  │
│  │                                                    [BTN ⬇ Descargar Informe]   │  │
│  │  ────────────────────────────────────────────────────────────────────────────    │  │
│  │  🔍 AUDITORÍA INTERNA — AI-2026-001                              🟡 EN PROCESO  │  │
│  │  Examen de Confiabilidad al Sistema de Trámites en Línea                        │  │
│  │  Gestión: 2026  |  Fecha inicio: 01 mar 2026                                    │  │
│  │                                                    (Informe pendiente)          │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 13. Transparencia — Dashboard de Gestión

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Institucional  >  Transparencia  >  Dashboard de Gestión                             │
│  ════════════════════════════════════════════════════════                               │
│                                                                                         │
│  Gestión: [2026 ↓]   Período: [Enero–Marzo ↓]   [BTN ⬇ Descargar datos CSV]          │
│                                                                                         │
│  ── EJECUCIÓN PRESUPUESTARIA ─────────────────────────────────────────────────────────  │
│  ┌────────────────────────────────────────────────────────────────────────────────┐    │
│  │   Presupuesto total: Bs 48.500.000                                             │    │
│  │   ████████████████████░░░░░░  68% ejecutado   Bs 32.980.000                   │    │
│  │   Por secretaría:                                                              │    │
│  │   Infraestructura ████████████████  80%   Bs 15.200.000                       │    │
│  │   Desarrollo Humano ████████████░   65%   Bs 8.400.000                        │    │
│  │   Administración  █████████░░░░░░   55%   Bs 5.100.000                        │    │
│  └────────────────────────────────────────────────────────────────────────────────┘    │
│                                                                                         │
│  ── INDICADORES CLAVE ────────────────────────────────────────────────────────────────  │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  │
│  │  🏗️  47      │  │  📋 1.430   │  │  🎓  82     │  │  🏥  12     │  │  ✅  31     │  │
│  │  Obras en   │  │  Trámites   │  │  Unidades   │  │  Centros    │  │  Obras      │  │
│  │  ejecución  │  │  este mes   │  │  educativas │  │  de salud   │  │  concluidas │  │
│  └─────────────┘  └─────────────┘  └─────────────┘  └─────────────┘  └─────────────┘  │
│                                                                                         │
│  ── DOCUMENTOS DE TRANSPARENCIA ─────────────────────────────────────────────────────  │
│  📄 Declaración de Bienes — Autoridades 2026      [⬇ PDF]                              │
│  📄 Nómina de Personal y Escala Salarial 2026     [⬇ XLSX]                             │
│  📄 Presupuesto 2026 en datos abiertos            [⬇ CSV]                              │
│  📄 Contratos suscritos Ene–Mar 2026              [⬇ PDF]                              │
│  📄 Informe de Auditoría Interna 2025             [⬇ PDF]                              │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 14. Información Financiera

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Información Financiera                                                                │
│  ════════════════════════                                                               │
│                                                                                         │
│  [Tab: POA]  [Tab: PEI]  [Tab: Presupuesto]  [Tab: Ejecución]  [Tab: Rendición]       │
│  ─────────────────────────────────────────────────────────────────────────────────────  │
│                                                                                         │
│  ── TAB: PLAN OPERATIVO ANUAL (POA) ─────────────────────────────────────────────────   │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  📄 POA 2026 — Gestión vigente                          [BTN ⬇ Descargar PDF]   │  │
│  │     Aprobado: 15 dic 2025  |  Secretarías: 8  |  Programas: 42                  │  │
│  │     [BTN Ver resumen ejecutivo →]                                                │  │
│  │  ──────────────────────────────────────────────────────────────────────────────  │  │
│  │  📄 POA 2025 (histórico)                                [BTN ⬇ Descargar PDF]   │  │
│  │  📄 POA 2024 (histórico)                                [BTN ⬇ Descargar PDF]   │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
│                                                                                         │
│  ── TAB: PLAN ESTRATÉGICO INSTITUCIONAL (PEI) ───────────────────────────────────────   │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  📄 PEI 2025–2030 — Plan Estratégico Institucional      [BTN ⬇ Descargar PDF]   │  │
│  │     Horizonte: 5 años  |  Ejes estratégicos: 6  |  Objetivos: 24               │  │
│  │                                                                                  │  │
│  │  EJES ESTRATÉGICOS                                                               │  │
│  │  🔵 Eje 1: Desarrollo Humano y Social                                           │  │
│  │  🟢 Eje 2: Infraestructura y Servicios Básicos                                  │  │
│  │  🟡 Eje 3: Gestión Ambiental y Territorial                                      │  │
│  │  🟠 Eje 4: Desarrollo Económico Local                                           │  │
│  │  🔴 Eje 5: Gobernanza y Participación Ciudadana                                 │  │
│  │  🟣 Eje 6: Modernización Institucional                                          │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
│                                                                                         │
│  ── TAB: EJECUCIÓN PRESUPUESTARIA ──────────────────────────────────────────────────    │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  Mes: [Enero ↓]  Gestión: [2026 ↓]             [BTN ⬇ Descargar CSV / XLSX]    │  │
│  │                                                                                  │  │
│  │  Secretaría          Presupuesto       Ejecutado     % Avance                   │  │
│  │  Infraestructura     Bs 19.000.000     15.200.000      80%  ████████████████    │  │
│  │  Desarrollo Humano   Bs 12.900.000      8.400.000      65%  ████████████░░░     │  │
│  │  Administración      Bs  9.300.000      5.100.000      55%  █████████░░░░░░     │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 15. Gobierno Electrónico — Portal Ciudadano

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  👤 Bienvenido/a, Juan Carlos Mamani                    [BTN Cerrar sesión]            │
│  Gobierno Electrónico  >  Mi Panel                                                     │
│  ══════════════════════════════════                                                     │
│                                                                                         │
│  ┌─────────────────┐  ┌─────────────────┐  ┌─────────────────┐                        │
│  │  📋  3          │  │  💰  2           │  │  🔔  1          │                        │
│  │  Trámites       │  │  Pagos           │  │  Notificación   │                        │
│  │  activos        │  │  realizados      │  │  pendiente      │                        │
│  └─────────────────┘  └─────────────────┘  └─────────────────┘                        │
│                                                                                         │
│  ── MIS TRÁMITES ───────────────────────────────────────────────────────────────────   │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  EXP-2026-001452  Licencia de Funcionamiento         🟡 EN PROCESO   [Ver →]    │  │
│  │  EXP-2026-000892  Certificación Catastral             🟢 APROBADO    [Ver →]    │  │
│  │  EXP-2026-000341  Pago IMBI 2026                      ✅ COMPLETADO  [Ver →]    │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
│                                                                                         │
│  ── MIS PAGOS ──────────────────────────────────────────────────────────────────────   │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  COMP-2026-00234  IMBI · Inmueble Lote 45-B    Bs 1.240  22/02/2026  [⬇ Comp.] │  │
│  │  COMP-2026-00098  IMT · Placa ABC-123           Bs 380   10/01/2026  [⬇ Comp.] │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
│                                                                                         │
│  [BTN + Nuevo trámite]  [BTN 💳 Pagar impuesto]  [BTN 📄 Mis documentos]              │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 16. Contacto y Directorio

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│  Contacto y Directorio Institucional                                                   │
│  ════════════════════════════════════                                                   │
│                                                                                         │
│  ┌──────────────────────────────────────────┐  ┌──────────────────────────────────┐   │
│  │  ENVIANOS UN MENSAJE                     │  │  DIRECTORIO RÁPIDO               │   │
│  │  ──────────────────────────────────────  │  │  ──────────────────────────────  │   │
│  │  Nombre:  [ Juan Carlos Mamani     ]     │  │  🏛  Ejecutivo Municipal          │   │
│  │  Email:   [ juan@email.com         ]     │  │     📞 000-0001                  │   │
│  │  Teléf.:  [ 7X XXX XXX            ]     │  │     ✉ alcalde@achocalla.bo       │   │
│  │  Área:    [ Seleccionar área... ↓  ]     │  │  💰  Sec. Adm. y Finanzas        │   │
│  │  Asunto:  [ Consulta sobre...      ]     │  │     📞 000-0002                  │   │
│  │  Mensaje:                                │  │  🏗  Sec. de Infraestructura     │   │
│  │  ┌──────────────────────────────────┐   │  │     📞 000-0003                  │   │
│  │  │                                  │   │  │  👥  Sec. de Desarrollo Humano   │   │
│  │  └──────────────────────────────────┘   │  │     📞 000-0004                  │   │
│  │  [✓] No soy un robot (CAPTCHA)          │  │                                  │   │
│  │  [BTN  Enviar mensaje  ✉]              │  │  [BTN Ver directorio completo →] │   │
│  └──────────────────────────────────────────┘  └──────────────────────────────────┘   │
│                                                                                         │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │              [MAPA INTERACTIVO — ubicación sede central y subalcaldías]          │  │
│  │  📍 Sede Central   📍 Subalcaldía Norte   📍 Subalcaldía Sur                    │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 17. Login — Registro Ciudadano

```text
┌─────────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                         │
│              [IMG escudo]  GOBIERNO AUTÓNOMO MUNICIPAL DE ACHOCALLA                    │
│                                                                                         │
│  ┌────────────────────────────────────┐  ┌────────────────────────────────────────┐   │
│  │        INICIAR SESIÓN              │  │       CREAR CUENTA CIUDADANA           │   │
│  │  ──────────────────────────────    │  │  ──────────────────────────────────    │   │
│  │  Email o CI:                       │  │  Nombre:   [ Nombres          ]        │   │
│  │  [ ejemplo@email.com          ]    │  │  Apellido: [ Apellidos        ]        │   │
│  │  Contraseña:                       │  │  CI:       [ 12345678         ]        │   │
│  │  [ ••••••••••••••••           ]    │  │  Email:    [ email@ejemplo.com]        │   │
│  │                                    │  │  Teléfono: [ 7XXXXXXX         ]        │   │
│  │  [BTN  Iniciar sesión  →]         │  │  Contraseña:[ ••••••••••••   ]         │   │
│  │  ¿Olvidaste tu contraseña?         │  │  Confirmar: [ ••••••••••••   ]         │   │
│  │  [Recuperar acceso →]              │  │  [✓] Acepto los términos de uso        │   │
│  │  ─────────────────────────────     │  │  [BTN  Registrarme  →]                │   │
│  │  O ingresá con:                    │  │  ¿Ya tenés cuenta?                     │   │
│  │  [BTN [G] Google]                  │  │  [Iniciar sesión →]                    │   │
│  └────────────────────────────────────┘  └────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 18. Versión Móvil — Home

> Resolución 390px. Navegación hamburguesa. Cards apilados en 2 columnas.

```text
        ┌─────────────────────────┐
        │ [IMG logo color]    ☰  │  ← Header móvil: logo + hamburguesa
        │ GAM Achocalla           │
        └─────────────────────────┘

        ┌─────────────────────────┐
        │ [IMG FONDO SLIDESHOW    │  ← Hero fullscreen Ken Burns
        │  fullscreen, card       │
        │  pequeño con logo       │
        │  institucional centrado]│
        │  [BTN Ver galería]      │
        └─────────────────────────┘

        ┌─────────────────────────┐
        │  ¿QUÉ NECESITÁS HOY?    │
        │  ┌──────────┐ ┌───────┐ │
        │  │ 🏠 IMPU- │ │ 🚗    │ │
        │  │ ESTOS    │ │VEHIC. │ │
        │  └──────────┘ └───────┘ │
        │  ┌──────────┐ ┌───────┐ │
        │  │ 🗺️ CATAS-│ │ 🏪    │ │
        │  │ TRO      │ │NEGOC. │ │
        │  └──────────┘ └───────┘ │
        │  ┌──────────┐ ┌───────┐ │
        │  │ 👨‍👩‍👧 SOC- │ │ 📋    │ │
        │  │ IAL      │ │SEGUIM.│ │
        │  └──────────┘ └───────┘ │
        └─────────────────────────┘

        ┌─────────────────────────┐
        │  ÚLTIMAS NOTICIAS       │
        │  ┌─────────────────────┐│
        │  │[IMG] 🏷Obras 20mar  ││
        │  │Alcaldía inaugura... ││
        │  │[Leer más →]         ││
        │  └─────────────────────┘│
        │  ┌─────────────────────┐│
        │  │[IMG] 🏷Social 17mar ││
        │  │Nueva resolución...  ││
        │  │[Leer más →]         ││
        │  └─────────────────────┘│
        └─────────────────────────┘

        ┌─────────────────────────┐
        │  GESTIÓN EN NÚMEROS     │
        │  ┌────────┐  ┌────────┐ │
        │  │  68%   │  │   47   │ │
        │  │Presup. │  │ Obras  │ │
        │  └────────┘  └────────┘ │
        │  ┌────────┐  ┌────────┐ │
        │  │   82   │  │ 1.430  │ │
        │  │Escuelas│  │Trámites│ │
        │  └────────┘  └────────┘ │
        └─────────────────────────┘

        ┌─────────────────────────┐
        │ [escudo]  Alcaldía      │  ← Footer móvil
        │ Achocalla               │
        │ [f][𝕏][📷][▶][💬]      │
        │ © 2026                  │
        └─────────────────────────┘
```

---

## Paleta de Colores Sugerida

```text
  COLOR PRIMARIO              COLOR SECUNDARIO            ACENTO
  ┌────────────────────┐      ┌────────────────────┐      ┌────────────────────┐
  │                    │      │                    │      │                    │
  │     #1A3A6B        │      │     #2E7D32        │      │     #F57C00        │
  │  Azul Institucional│      │  Verde Gestión     │      │  Naranja CTA       │
  └────────────────────┘      └────────────────────┘      └────────────────────┘

  ESTADOS DE TRÁMITE / DOCUMENTOS:
  🟢 #2E7D32  Aprobado / Vigente / Completado
  🟡 #F9A825  En proceso / Modificado
  🔴 #C62828  Rechazado / Derogado
  🔵 #1565C0  Recibido / Información
  ⚪ #757575  Archivado / Histórico

  FONDOS:  Principal #F5F7FA · Cards #FFFFFF · Navbar fondo oscuro
  TEXTO:   Principal #1A1A2E · Secundario #546E7A
```

---

## Tipografía Sugerida

| Uso | Fuente | Tamaño |
|-----|--------|--------|
| Títulos principales | Montserrat Bold | 32–48px |
| Títulos de sección | Montserrat SemiBold | 24–28px |
| Subtítulos | Roboto Medium | 18–20px |
| Cuerpo de texto | Roboto Regular | 16px |
| Labels / etiquetas | Lato Regular | 13–14px |
| Botones | Montserrat SemiBold | 14–16px |

> Las fuentes Montserrat, Roboto y Lato son las mismas utilizadas por el GAMEA El Alto.

---

## Resumen de Pantallas

| Pantalla | Sección en el menú | Secciones clave |
| -------- | ------------------ | --------------- |
| Home | — | Hero slideshow · Accesos rápidos · Noticias · Stats · Agenda |
| Autoridad Municipal | Institucional | Alcalde destacado · Concejo · Secretarios en cards |
| Organigrama | Institucional | Árbol interactivo con tooltips · Descarga PDF |
| Manuales y Escala | Recursos Humanos | Nómina · MOF · MPP · Escala Salarial descargable |
| Catálogo Trámites | Servicios | Buscador + filtros + agrupado por categoría |
| Detalle Trámite | Servicios | Ficha + sidebar + requisitos + formularios |
| Noticias | Comunicación | Grid con filtros · Sidebar populares y archivo |
| Historia e Himno | Comunicación | Línea de tiempo · Galería histórica · Audio himno |
| Gaceta Municipal | Normativa | Buscador avanzado · Filtro tipo/año/vigencia |
| Auditorías | Institucional / Transparencia | Listado con tipo · Estado · Descarga |
| Dashboard Transparencia | Institucional / Transparencia | Barras presupuestarias · KPIs · Docs |
| Información Financiera | Información Financiera | Tabs: POA · PEI · Presupuesto · Ejecución |
| Portal Ciudadano | Gobierno Electrónico | Panel personal · Trámites · Pagos · Acciones |
| Contacto | Contacto | Formulario · Directorio · Mapa embed |
| Login / Registro | — | Panel dual · OAuth Google |
| Móvil | — | Grid 2 columnas · Cards apilados · Hamburguesa |
