"""
Generador de XML para draw.io — Base de datos Portal Web Alcaldía Municipal
Genera un archivo .drawio con todas las tablas organizadas por módulo.
"""

import xml.etree.ElementTree as ET

# ─── DEFINICIÓN DE TABLAS ────────────────────────────────────────────────────
# Formato: (nombre_tabla, color_hex, [(columna, tipo, clave), ...])
# clave: "PK" | "FK" | "UK" | ""

MODULOS = [
    {
        "nombre": "01 · Usuarios y Autenticación",
        "color_header": "#1e3a5f",
        "color_fill":   "#dbe9f7",
        "tablas": [
            ("usuarios", [
                ("id",                  "bigserial",  "PK"),
                ("nombre",              "varchar(100)",""),
                ("apellido",            "varchar(100)",""),
                ("email",               "varchar(150)","UK"),
                ("password_hash",       "varchar(255)",""),
                ("tipo",                "varchar(20)", ""),
                ("ci",                  "varchar(20)", ""),
                ("telefono",            "varchar(50)", ""),
                ("activo",              "boolean",     ""),
                ("email_verificado",    "boolean",     ""),
                ("created_at",          "timestamptz", ""),
                ("updated_at",          "timestamptz", ""),
                ("deleted_at",          "timestamptz", ""),
            ]),
            ("roles", [
                ("id",          "serial",       "PK"),
                ("nombre",      "varchar(80)",  "UK"),
                ("descripcion", "varchar(255)", ""),
                ("activo",      "boolean",      ""),
            ]),
            ("permisos", [
                ("id",          "serial",       "PK"),
                ("codigo",      "varchar(100)", "UK"),
                ("descripcion", "varchar(150)", ""),
                ("modulo",      "varchar(50)",  ""),
            ]),
            ("roles_permisos", [
                ("id",          "serial", "PK"),
                ("rol_id",      "int",    "FK"),
                ("permiso_id",  "int",    "FK"),
            ]),
            ("usuarios_roles", [
                ("id",           "bigserial",  "PK"),
                ("usuario_id",   "bigint",     "FK"),
                ("rol_id",       "int",        "FK"),
                ("asignado_at",  "timestamptz",""),
                ("asignado_por", "bigint",     "FK"),
            ]),
            ("sesiones", [
                ("id",          "bigserial",  "PK"),
                ("usuario_id",  "bigint",     "FK"),
                ("token_hash",  "varchar(255)","UK"),
                ("ip_address",  "varchar(50)", ""),
                ("user_agent",  "text",        ""),
                ("expira_at",   "timestamptz", ""),
                ("created_at",  "timestamptz", ""),
            ]),
        ]
    },
    {
        "nombre": "02 · Configuración del Sitio",
        "color_header": "#2d5016",
        "color_fill":   "#dff0d8",
        "tablas": [
            ("configuracion_sitio", [
                ("id",              "serial",       "PK"),
                ("clave",           "varchar(100)", "UK"),
                ("valor",           "text",         ""),
                ("tipo_dato",       "varchar(50)",  ""),
                ("descripcion",     "varchar(150)", ""),
                ("updated_at",      "timestamptz",  ""),
                ("actualizado_por", "bigint",       "FK"),
            ]),
            ("menus", [
                ("id",          "serial",       "PK"),
                ("nombre",      "varchar(80)",  "UK"),
                ("descripcion", "varchar(100)", ""),
                ("activo",      "boolean",      ""),
            ]),
            ("menu_items", [
                ("id",                 "serial",       "PK"),
                ("menu_id",            "int",          "FK"),
                ("parent_id",          "int",          "FK"),
                ("etiqueta",           "varchar(150)", ""),
                ("url",                "varchar(255)", ""),
                ("orden",              "int",          ""),
                ("icono",              "varchar(50)",  ""),
                ("activo",             "boolean",      ""),
                ("abrir_nueva_ventana","boolean",      ""),
            ]),
            ("banners", [
                ("id",           "serial",       "PK"),
                ("titulo",       "varchar(200)", ""),
                ("descripcion",  "text",         ""),
                ("imagen_url",   "varchar(255)", ""),
                ("url_destino",  "varchar(255)", ""),
                ("texto_boton",  "varchar(255)", ""),
                ("orden",        "int",          ""),
                ("activo",       "boolean",      ""),
                ("fecha_inicio", "date",         ""),
                ("fecha_fin",    "date",         ""),
                ("creado_por",   "bigint",       "FK"),
                ("created_at",   "timestamptz",  ""),
            ]),
            ("redes_sociales", [
                ("id",           "serial",       "PK"),
                ("plataforma",   "varchar(50)",  ""),
                ("url",          "varchar(255)", ""),
                ("nombre_cuenta","varchar(100)", ""),
                ("icono_clase",  "varchar(100)", ""),
                ("activo",       "boolean",      ""),
                ("orden",        "int",          ""),
            ]),
        ]
    },
    {
        "nombre": "03 · Autoridades e Institucional",
        "color_header": "#5c3317",
        "color_fill":   "#fdf0e0",
        "tablas": [
            ("secretarias", [
                ("id",                 "serial",       "PK"),
                ("nombre",             "varchar(200)", ""),
                ("sigla",              "varchar(200)", ""),
                ("slug",               "varchar(200)", "UK"),
                ("atribuciones",       "text",         ""),
                ("direccion_fisica",   "varchar(200)", ""),
                ("telefono",           "varchar(50)",  ""),
                ("email",              "varchar(150)", ""),
                ("horario_atencion",   "varchar(50)",  ""),
                ("foto_titular_url",   "varchar(255)", ""),
                ("orden_organigrama",  "int",          ""),
                ("activa",             "boolean",      ""),
                ("search_vector",      "tsvector",     ""),
                ("created_at",         "timestamptz",  ""),
                ("updated_at",         "timestamptz",  ""),
            ]),
            ("autoridades", [
                ("id",                    "bigserial",    "PK"),
                ("secretaria_id",         "int",          "FK"),
                ("nombre",                "varchar(100)", ""),
                ("apellido",              "varchar(100)", ""),
                ("cargo",                 "varchar(100)", ""),
                ("tipo",                  "varchar(50)",  ""),
                ("slug",                  "varchar(250)", "UK"),
                ("perfil_profesional",    "text",         ""),
                ("email_institucional",   "varchar(150)", ""),
                ("foto_url",              "varchar(255)", ""),
                ("orden",                 "int",          ""),
                ("activo",                "boolean",      ""),
                ("fecha_inicio_cargo",    "date",         ""),
                ("fecha_fin_cargo",       "date",         ""),
                ("search_vector",         "tsvector",     ""),
                ("created_at",            "timestamptz",  ""),
            ]),
            ("subcenefcos", [
                ("id",                  "serial",       "PK"),
                ("nombre",              "varchar(150)", ""),
                ("slug",                "varchar(200)", "UK"),
                ("zona_cobertura",      "varchar(200)", ""),
                ("direccion_fisica",    "varchar(200)", ""),
                ("telefono",            "varchar(50)",  ""),
                ("email",               "varchar(150)", ""),
                ("imagen_url",          "varchar(255)", ""),
                ("latitud",             "float",        ""),
                ("longitud",            "float",        ""),
                ("tramites_disponibles","text",         ""),
                ("activa",              "boolean",      ""),
                ("created_at",          "timestamptz",  ""),
            ]),
            ("organigrama", [
                ("id",                "serial",       "PK"),
                ("secretaria_id",     "int",          "FK"),
                ("parent_id",         "int",          "FK"),
                ("nivel",             "int",          ""),
                ("orden",             "int",          ""),
                ("imagen_url",        "varchar(255)", ""),
                ("fecha_actualizacion","date",         ""),
                ("vigente",           "boolean",      ""),
            ]),
        ]
    },
    {
        "nombre": "04 · Noticias y Comunicados",
        "color_header": "#7b003c",
        "color_fill":   "#fce4ec",
        "tablas": [
            ("categorias_noticia", [
                ("id",          "serial",       "PK"),
                ("nombre",      "varchar(100)", "UK"),
                ("slug",        "varchar(100)", "UK"),
                ("descripcion", "varchar(255)", ""),
                ("color_hex",   "varchar(50)",  ""),
                ("activa",      "boolean",      ""),
            ]),
            ("etiquetas", [
                ("id",     "serial",      "PK"),
                ("nombre", "varchar(80)", "UK"),
                ("slug",   "varchar(80)", "UK"),
            ]),
            ("noticias", [
                ("id",                  "bigserial",    "PK"),
                ("categoria_id",        "int",          "FK"),
                ("autor_id",            "bigint",       "FK"),
                ("titulo",              "varchar(300)", ""),
                ("slug",                "varchar(300)", "UK"),
                ("entradilla",          "varchar(500)", ""),
                ("cuerpo",              "text",         ""),
                ("imagen_principal_url","varchar(255)", ""),
                ("imagen_alt",          "varchar(255)", ""),
                ("estado",              "varchar(50)",  ""),
                ("destacada",           "boolean",      ""),
                ("fecha_publicacion",   "timestamptz",  ""),
                ("vistas",              "int",          ""),
                ("meta_titulo",         "varchar(300)", ""),
                ("meta_descripcion",    "varchar(500)", ""),
                ("search_vector",       "tsvector",     ""),
                ("created_at",          "timestamptz",  ""),
                ("updated_at",          "timestamptz",  ""),
                ("deleted_at",          "timestamptz",  ""),
            ]),
            ("noticias_etiquetas", [
                ("noticia_id",  "bigint", "FK"),
                ("etiqueta_id", "int",    "FK"),
            ]),
            ("comunicados", [
                ("id",                  "bigserial",    "PK"),
                ("autor_id",            "bigint",       "FK"),
                ("titulo",              "varchar(300)", ""),
                ("slug",                "varchar(300)", "UK"),
                ("tipo",                "varchar(100)", ""),
                ("contenido",           "text",         ""),
                ("imagen_url",          "varchar(255)", ""),
                ("estado",              "varchar(50)",  ""),
                ("fecha_publicacion",   "timestamptz",  ""),
                ("fecha_vigencia_hasta","date",         ""),
                ("search_vector",       "tsvector",     ""),
                ("created_at",          "timestamptz",  ""),
            ]),
            ("multimedia", [
                ("id",            "bigserial",    "PK"),
                ("noticia_id",    "bigint",       "FK"),
                ("comunicado_id", "bigint",       "FK"),
                ("tipo",          "varchar(50)",  ""),
                ("url",           "varchar(255)", ""),
                ("thumbnail_url", "varchar(255)", ""),
                ("titulo",        "varchar(300)", ""),
                ("descripcion",   "varchar(500)", ""),
                ("orden",         "int",          ""),
                ("subido_por",    "bigint",       "FK"),
                ("created_at",    "timestamptz",  ""),
            ]),
        ]
    },
    {
        "nombre": "05 · Agenda Institucional",
        "color_header": "#1a237e",
        "color_fill":   "#e8eaf6",
        "tablas": [
            ("tipos_evento", [
                ("id",        "serial",       "PK"),
                ("nombre",    "varchar(100)", ""),
                ("color_hex", "varchar(50)",  ""),
                ("activo",    "boolean",      ""),
            ]),
            ("eventos", [
                ("id",              "bigserial",    "PK"),
                ("tipo_evento_id",  "int",          "FK"),
                ("creado_por",      "bigint",       "FK"),
                ("titulo",          "varchar(300)", ""),
                ("slug",            "varchar(350)", "UK"),
                ("descripcion",     "text",         ""),
                ("lugar",           "varchar(200)", ""),
                ("latitud",         "float",        ""),
                ("longitud",        "float",        ""),
                ("fecha_inicio",    "timestamptz",  ""),
                ("fecha_fin",       "timestamptz",  ""),
                ("todo_el_dia",     "boolean",      ""),
                ("estado",          "varchar(50)",  ""),
                ("url_transmision", "varchar(255)", ""),
                ("publico",         "boolean",      ""),
                ("search_vector",   "tsvector",     ""),
                ("created_at",      "timestamptz",  ""),
            ]),
        ]
    },
    {
        "nombre": "06 · Normativa",
        "color_header": "#4a148c",
        "color_fill":   "#f3e5f5",
        "tablas": [
            ("tipos_norma", [
                ("id",          "serial",       "PK"),
                ("nombre",      "varchar(100)", ""),
                ("sigla",       "varchar(80)",  ""),
                ("slug",        "varchar(100)", "UK"),
                ("descripcion", "varchar(200)", ""),
                ("activo",      "boolean",      ""),
            ]),
            ("normas", [
                ("id",                       "bigserial",    "PK"),
                ("tipo_norma_id",             "int",          "FK"),
                ("publicado_por",             "bigint",       "FK"),
                ("numero",                    "varchar(50)",  ""),
                ("titulo",                    "varchar(400)", ""),
                ("slug",                      "varchar(450)", "UK"),
                ("resumen",                   "text",         ""),
                ("texto_completo",            "text",         ""),
                ("archivo_pdf_url",           "varchar(255)", ""),
                ("fecha_promulgacion",        "date",         ""),
                ("fecha_publicacion_gaceta",  "date",         ""),
                ("estado_vigencia",           "varchar(50)",  ""),
                ("tema_principal",            "varchar(100)", ""),
                ("palabras_clave",            "varchar(500)", ""),
                ("vistas",                    "int",          ""),
                ("search_vector",             "tsvector",     ""),
                ("created_at",                "timestamptz",  ""),
                ("updated_at",                "timestamptz",  ""),
            ]),
        ]
    },
    {
        "nombre": "07 · Trámites y Servicios",
        "color_header": "#004d40",
        "color_fill":   "#e0f2f1",
        "tablas": [
            ("unidades_responsables", [
                ("id",            "serial",       "PK"),
                ("secretaria_id", "int",          "FK"),
                ("nombre",        "varchar(200)", ""),
                ("direccion",     "varchar(200)", ""),
                ("telefono",      "varchar(50)",  ""),
                ("email",         "varchar(150)", ""),
                ("horario",       "varchar(80)",  ""),
                ("activa",        "boolean",      ""),
            ]),
            ("tipos_tramite", [
                ("id",         "serial",       "PK"),
                ("nombre",     "varchar(100)", ""),
                ("slug",       "varchar(100)", ""),
                ("icono_url",  "varchar(255)", ""),
                ("color_hex",  "varchar(50)",  ""),
                ("activo",     "boolean",      ""),
                ("orden",      "int",          ""),
            ]),
            ("tramites_catalogo", [
                ("id",                      "bigserial",    "PK"),
                ("tipo_tramite_id",          "int",          "FK"),
                ("unidad_responsable_id",    "int",          "FK"),
                ("creado_por",               "bigint",       "FK"),
                ("nombre",                   "varchar(300)", ""),
                ("slug",                     "varchar(300)", "UK"),
                ("descripcion",              "text",         ""),
                ("procedimiento",            "text",         ""),
                ("costo",                    "decimal",      ""),
                ("moneda",                   "varchar(50)",  ""),
                ("dias_habiles_resolucion",  "int",          ""),
                ("normativa_base",           "varchar(100)", ""),
                ("url_formulario",           "varchar(255)", ""),
                ("modalidad",                "varchar(50)",  ""),
                ("activo",                   "boolean",      ""),
                ("search_vector",            "tsvector",     ""),
                ("created_at",               "timestamptz",  ""),
                ("updated_at",               "timestamptz",  ""),
            ]),
            ("requisitos_tramite", [
                ("id",          "serial",       "PK"),
                ("tramite_id",  "bigint",       "FK"),
                ("nombre",      "varchar(300)", ""),
                ("descripcion", "text",         ""),
                ("obligatorio", "boolean",      ""),
                ("tipo",        "varchar(50)",  ""),
                ("orden",       "int",          ""),
            ]),
            ("formularios_tramite", [
                ("id",                 "serial",       "PK"),
                ("tramite_id",         "bigint",       "FK"),
                ("nombre",             "varchar(200)", ""),
                ("archivo_url",        "varchar(255)", ""),
                ("formato",            "varchar(10)",  ""),
                ("fecha_actualizacion","date",         ""),
                ("activo",             "boolean",      ""),
            ]),
        ]
    },
    {
        "nombre": "08 · POA y Presupuesto",
        "color_header": "#bf360c",
        "color_fill":   "#fbe9e7",
        "tablas": [
            ("planes_gobierno", [
                ("id",                "serial",       "PK"),
                ("titulo",            "varchar(200)", ""),
                ("gestion_inicio",    "int",          ""),
                ("gestion_fin",       "int",          ""),
                ("descripcion",       "text",         ""),
                ("documento_pdf_url", "varchar(255)", ""),
                ("publicado_por",     "bigint",       "FK"),
                ("vigente",           "boolean",      ""),
                ("created_at",        "timestamptz",  ""),
            ]),
            ("poa", [
                ("id",                    "serial",       "PK"),
                ("plan_gobierno_id",       "int",          "FK"),
                ("secretaria_id",          "int",          "FK"),
                ("gestion",               "int",          ""),
                ("titulo",                "varchar(200)", ""),
                ("documento_pdf_url",     "varchar(255)", ""),
                ("resumen_ejecutivo_url", "varchar(255)", ""),
                ("estado",                "varchar(50)",  ""),
                ("aprobado_por",          "bigint",       "FK"),
                ("fecha_aprobacion",      "date",         ""),
                ("created_at",            "timestamptz",  ""),
            ]),
            ("programas_poa", [
                ("id",                    "serial",       "PK"),
                ("poa_id",                "int",          "FK"),
                ("nombre",                "varchar(300)", ""),
                ("descripcion",           "text",         ""),
                ("presupuesto_asignado",  "decimal",      ""),
                ("meta_indicador",        "int",          ""),
                ("unidad_medida",         "varchar(100)", ""),
                ("estado",                "varchar(50)",  ""),
            ]),
            ("presupuestos", [
                ("id",               "serial",       "PK"),
                ("secretaria_id",    "int",          "FK"),
                ("gestion",          "int",          ""),
                ("monto_aprobado",   "decimal",      ""),
                ("monto_modificado", "decimal",      ""),
                ("estado",           "varchar(50)",  ""),
                ("documento_url",    "varchar(255)", ""),
                ("fecha_aprobacion", "date",         ""),
                ("aprobado_por",     "bigint",       "FK"),
                ("created_at",       "timestamptz",  ""),
            ]),
            ("partidas_presupuestarias", [
                ("id",              "bigserial",    "PK"),
                ("presupuesto_id",  "int",          "FK"),
                ("codigo_partida",  "varchar(30)",  ""),
                ("descripcion",     "varchar(300)", ""),
                ("monto_asignado",  "decimal",      ""),
                ("monto_ejecutado", "decimal",      ""),
                ("categoria",       "varchar(50)",  ""),
                ("updated_at",      "timestamptz",  ""),
            ]),
            ("ejecucion_presupuestaria", [
                ("id",                "bigserial",    "PK"),
                ("partida_id",        "bigint",       "FK"),
                ("proyecto_id",       "bigint",       "FK"),
                ("monto_devengado",   "decimal",      ""),
                ("monto_pagado",      "decimal",      ""),
                ("mes",               "int",          ""),
                ("gestion",           "int",          ""),
                ("descripcion_gasto", "varchar(200)", ""),
                ("fecha_registro",    "date",         ""),
                ("registrado_por",    "bigint",       "FK"),
                ("created_at",        "timestamptz",  ""),
            ]),
        ]
    },
    {
        "nombre": "09 · Gobierno Abierto y Transparencia",
        "color_header": "#006064",
        "color_fill":   "#e0f7fa",
        "tablas": [
            ("categorias_indicador", [
                ("id",       "serial",       "PK"),
                ("nombre",   "varchar(100)", ""),
                ("icono",    "varchar(50)",  ""),
                ("color_hex","varchar(50)",  ""),
                ("activa",   "boolean",      ""),
            ]),
            ("indicadores_gestion", [
                ("id",                      "serial",       "PK"),
                ("categoria_id",             "int",          "FK"),
                ("nombre",                   "varchar(200)", ""),
                ("descripcion",              "text",         ""),
                ("unidad_medida",            "varchar(50)",  ""),
                ("frecuencia_actualizacion", "varchar(50)",  ""),
                ("publico",                  "boolean",      ""),
                ("activo",                   "boolean",      ""),
                ("orden_dashboard",          "int",          ""),
            ]),
            ("valores_indicador", [
                ("id",             "bigserial",  "PK"),
                ("indicador_id",   "int",        "FK"),
                ("valor",          "decimal",    ""),
                ("mes",            "int",        ""),
                ("gestion",        "int",        ""),
                ("fecha_registro", "date",       ""),
                ("fuente",         "text",       ""),
                ("registrado_por", "bigint",     "FK"),
                ("created_at",     "timestamptz",""),
            ]),
            ("tipos_documento_transparencia", [
                ("id",     "serial",       "PK"),
                ("nombre", "varchar(100)", ""),
                ("activo", "boolean",      ""),
            ]),
            ("documentos_transparencia", [
                ("id",               "bigserial",    "PK"),
                ("tipo_documento_id","int",          "FK"),
                ("secretaria_id",    "int",          "FK"),
                ("publicado_por",    "bigint",       "FK"),
                ("titulo",           "varchar(300)", ""),
                ("slug",             "varchar(350)", "UK"),
                ("descripcion",      "text",         ""),
                ("archivo_url",      "varchar(255)", ""),
                ("gestion",          "int",          ""),
                ("fecha_publicacion","date",         ""),
                ("activo",           "boolean",      ""),
                ("search_vector",    "tsvector",     ""),
                ("created_at",       "timestamptz",  ""),
            ]),
        ]
    },
    {
        "nombre": "10 · Participación Ciudadana",
        "color_header": "#e65100",
        "color_fill":   "#fff3e0",
        "tablas": [
            ("audiencias_publicas", [
                ("id",                   "bigserial",    "PK"),
                ("evento_id",            "int",          "FK"),
                ("organiza_secretaria_id","bigint",      "FK"),
                ("titulo",               "varchar(300)", ""),
                ("slug",                 "varchar(350)", "UK"),
                ("descripcion",          "text",         ""),
                ("tipo",                 "varchar(50)",  ""),
                ("estado",               "varchar(50)",  ""),
                ("acta_url",             "varchar(255)", ""),
                ("video_url",            "varchar(255)", ""),
                ("asistentes",           "int",          ""),
                ("created_at",           "timestamptz",  ""),
            ]),
            ("consultas_ciudadanas", [
                ("id",          "serial",       "PK"),
                ("creado_por",  "bigint",       "FK"),
                ("pregunta",    "varchar(300)", ""),
                ("descripcion", "text",         ""),
                ("fecha_inicio","date",         ""),
                ("fecha_fin",   "date",         ""),
                ("activa",      "boolean",      ""),
                ("created_at",  "timestamptz",  ""),
            ]),
            ("opciones_consulta", [
                ("id",          "serial",       "PK"),
                ("consulta_id", "int",          "FK"),
                ("opcion",      "varchar(200)", ""),
                ("total_votos", "int",          ""),
            ]),
            ("votos_consulta", [
                ("id",          "bigserial",  "PK"),
                ("opcion_id",   "int",        "FK"),
                ("usuario_id",  "bigint",     "FK"),
                ("ip_address",  "varchar(50)",""),
                ("created_at",  "timestamptz",""),
            ]),
            ("sugerencias", [
                ("id",                   "bigserial",    "PK"),
                ("usuario_id",           "bigint",       "FK"),
                ("asunto",               "varchar(300)", ""),
                ("mensaje",              "text",         ""),
                ("email_respuesta",      "varchar(150)", ""),
                ("secretaria_destino_id","int",          "FK"),
                ("estado",               "varchar(50)",  ""),
                ("respuesta",            "text",         ""),
                ("respondido_por",       "bigint",       "FK"),
                ("respondido_at",        "timestamptz",  ""),
                ("created_at",           "timestamptz",  ""),
            ]),
        ]
    },
    {
        "nombre": "11 · Solicitudes de Información Pública",
        "color_header": "#37474f",
        "color_fill":   "#eceff1",
        "tablas": [
            ("solicitudes_informacion", [
                ("id",                      "bigserial",    "PK"),
                ("usuario_id",              "bigint",       "FK"),
                ("numero_caso",             "varchar(20)",  "UK"),
                ("nombre_solicitante",      "varchar(200)", ""),
                ("email_solicitante",       "varchar(150)", ""),
                ("telefono_solicitante",    "varchar(50)",  ""),
                ("secretaria_destino_id",   "int",          "FK"),
                ("descripcion_informacion", "text",         ""),
                ("formato_preferido",       "varchar(50)",  ""),
                ("estado",                  "varchar(50)",  ""),
                ("justificacion_denegacion","text",         ""),
                ("fecha_limite_respuesta",  "date",         ""),
                ("created_at",              "timestamptz",  ""),
            ]),
            ("respuestas_informacion", [
                ("id",                   "bigserial",  "PK"),
                ("solicitud_id",         "bigint",     "FK"),
                ("respondido_por",       "bigint",     "FK"),
                ("contenido_respuesta",  "text",       ""),
                ("archivo_respuesta_url","varchar(255)",""),
                ("respondido_at",        "timestamptz",""),
                ("created_at",           "timestamptz",""),
            ]),
        ]
    },
    {
        "nombre": "12 · Contacto y Directorio",
        "color_header": "#1b5e20",
        "color_fill":   "#e8f5e9",
        "tablas": [
            ("directorio_institucional", [
                ("id",                  "serial",       "PK"),
                ("secretaria_id",       "int",          "FK"),
                ("subcenefco_id",      "int",          "FK"),
                ("nombre_unidad",       "varchar(200)", ""),
                ("titular",             "varchar(200)", ""),
                ("direccion_fisica",    "varchar(200)", ""),
                ("telefono_principal",  "varchar(50)",  ""),
                ("telefono_secundario", "varchar(50)",  ""),
                ("email_institucional", "varchar(150)", ""),
                ("horario_lunes_viernes","varchar(80)", ""),
                ("horario_sabado",      "varchar(80)",  ""),
                ("latitud",             "float",        ""),
                ("longitud",            "float",        ""),
                ("orden",               "int",          ""),
                ("activo",              "boolean",      ""),
                ("updated_at",          "timestamptz",  ""),
            ]),
            ("mensajes_contacto", [
                ("id",                  "bigserial",    "PK"),
                ("secretaria_destino_id","int",         "FK"),
                ("nombre_remitente",    "varchar(150)", ""),
                ("email_remitente",     "varchar(150)", ""),
                ("telefono_remitente",  "varchar(50)",  ""),
                ("asunto",              "varchar(200)", ""),
                ("mensaje",             "text",         ""),
                ("estado",              "varchar(50)",  ""),
                ("respuesta",           "text",         ""),
                ("respondido_por",      "bigint",       "FK"),
                ("respondido_at",       "timestamptz",  ""),
                ("ip_origen",           "varchar(50)",  ""),
                ("created_at",          "timestamptz",  ""),
            ]),
        ]
    },
    {
        "nombre": "13 · Recursos Humanos",
        "color_header": "#4e342e",
        "color_fill":   "#efebe9",
        "tablas": [
            ("manuales_institucionales", [
                ("id",               "serial",       "PK"),
                ("tipo",             "varchar(50)",  ""),
                ("titulo",           "varchar(300)", ""),
                ("descripcion",      "text",         ""),
                ("archivo_url",      "varchar(255)", ""),
                ("formato",          "varchar(10)",  ""),
                ("numero_paginas",   "int",          ""),
                ("gestion",          "int",          ""),
                ("version",          "int",          ""),
                ("vigente",          "boolean",      ""),
                ("publicado_por",    "bigint",       "FK"),
                ("fecha_publicacion","date",         ""),
                ("descargas",        "int",          ""),
                ("created_at",       "timestamptz",  ""),
            ]),
            ("escala_salarial", [
                ("id",               "serial",       "PK"),
                ("gestion",          "int",          ""),
                ("titulo",           "varchar(200)", ""),
                ("descripcion",      "text",         ""),
                ("archivo_pdf_url",  "varchar(255)", ""),
                ("archivo_xlsx_url", "varchar(255)", ""),
                ("vigente",          "boolean",      ""),
                ("publicado_por",    "bigint",       "FK"),
                ("fecha_aprobacion", "date",         ""),
                ("descargas",        "int",          ""),
                ("created_at",       "timestamptz",  ""),
            ]),
            ("nomina_personal", [
                ("id",              "bigserial",    "PK"),
                ("usuario_id",      "bigint",       "FK"),
                ("secretaria_id",   "int",          "FK"),
                ("nombre",          "varchar(100)", ""),
                ("apellido",        "varchar(100)", ""),
                ("ci",              "varchar(20)",  ""),
                ("cargo",           "varchar(200)", ""),
                ("nivel_salarial",  "varchar(50)",  ""),
                ("tipo_contrato",   "varchar(50)",  ""),
                ("gestion",         "int",          ""),
                ("activo",          "boolean",      ""),
                ("created_at",      "timestamptz",  ""),
                ("updated_at",      "timestamptz",  ""),
            ]),
        ]
    },
    {
        "nombre": "14 · Contenido Institucional",
        "color_header": "#0d47a1",
        "color_fill":   "#e3f2fd",
        "tablas": [
            ("historia_municipio", [
                ("id",              "serial",       "PK"),
                ("titulo_seccion",  "varchar(300)", ""),
                ("contenido_html",  "text",         ""),
                ("orden",           "int",          ""),
                ("epoca",           "varchar(50)",  ""),
                ("imagen_url",      "varchar(255)", ""),
                ("activa",          "boolean",      ""),
                ("actualizado_por", "bigint",       "FK"),
                ("updated_at",      "timestamptz",  ""),
            ]),
            ("himno", [
                ("id",             "serial",       "PK"),
                ("titulo",         "varchar(200)", ""),
                ("letra",          "text",         ""),
                ("audio_url",      "varchar(255)", ""),
                ("partitura_pdf_url","varchar(255)",""),
                ("compositor",     "varchar(200)", ""),
                ("letrista",       "varchar(200)", ""),
                ("fecha_adopcion", "date",         ""),
                ("vigente",        "boolean",      ""),
                ("updated_at",     "timestamptz",  ""),
            ]),
            ("plan_estrategico_institucional", [
                ("id",               "serial",       "PK"),
                ("titulo",           "varchar(200)", ""),
                ("anio_inicio",      "int",          ""),
                ("anio_fin",         "int",          ""),
                ("descripcion",      "text",         ""),
                ("documento_pdf_url","varchar(255)", ""),
                ("estado",           "varchar(50)",  ""),
                ("aprobado_por",     "bigint",       "FK"),
                ("fecha_aprobacion", "date",         ""),
                ("vigente",          "boolean",      ""),
                ("created_at",       "timestamptz",  ""),
            ]),
            ("ejes_pei", [
                ("id",                "serial",       "PK"),
                ("pei_id",            "int",          "FK"),
                ("numero_eje",        "int",          ""),
                ("nombre",            "varchar(200)", ""),
                ("descripcion",       "text",         ""),
                ("color_hex",         "varchar(50)",  ""),
                ("total_objetivos",   "int",          ""),
                ("objetivos_cumplidos","int",         ""),
                ("updated_at",        "timestamptz",  ""),
            ]),
        ]
    },
    {
        "nombre": "15 · Auditorías",
        "color_header": "#212121",
        "color_fill":   "#f5f5f5",
        "tablas": [
            ("tipos_auditoria", [
                ("id",          "serial",       "PK"),
                ("nombre",      "varchar(100)", ""),
                ("descripcion", "varchar(255)", ""),
                ("activo",      "boolean",      ""),
            ]),
            ("auditorias", [
                ("id",                    "bigserial",    "PK"),
                ("tipo_auditoria_id",     "int",          "FK"),
                ("secretaria_auditada_id","int",          "FK"),
                ("publicado_por",         "bigint",       "FK"),
                ("codigo_auditoria",      "varchar(30)",  "UK"),
                ("slug",                  "varchar(350)", "UK"),
                ("titulo",                "varchar(300)", ""),
                ("objeto_examen",         "text",         ""),
                ("entidad_auditora",      "varchar(200)", ""),
                ("gestion_auditada",      "int",          ""),
                ("fecha_inicio",          "date",         ""),
                ("fecha_fin",             "date",         ""),
                ("estado",                "varchar(50)",  ""),
                ("informe_pdf_url",       "varchar(255)", ""),
                ("publico",               "boolean",      ""),
                ("created_at",            "timestamptz",  ""),
                ("updated_at",            "timestamptz",  ""),
            ]),
            ("hallazgos_auditoria", [
                ("id",                      "bigserial",    "PK"),
                ("auditoria_id",            "bigint",       "FK"),
                ("tipo",                    "varchar(50)",  ""),
                ("descripcion",             "text",         ""),
                ("recomendacion",           "text",         ""),
                ("estado_seguimiento",      "varchar(50)",  ""),
                ("secretaria_responsable_id","int",         "FK"),
                ("fecha_limite",            "date",         ""),
                ("respuesta_unidad",        "text",         ""),
                ("created_at",              "timestamptz",  ""),
                ("updated_at",              "timestamptz",  ""),
            ]),
        ]
    },
]

# ─── RELACIONES ──────────────────────────────────────────────────────────────
# Formato: (tabla_origen, tabla_destino, tipo, etiqueta)
# tipo: "1N" = uno a muchos  |  "NN" = pivot/muchos a muchos  |  "11" = uno a uno
#
# NOTA: Todas las FK son 1:N. Las N:M se representan via tablas pivot con 2×1N.
# "NN" se usa para colorear diferente las relaciones hacia tablas pivot (noticias_etiquetas, etc.)

RELACIONES = [
    # ── Módulo 1: Usuarios y Autenticación ───────────────────────────────────
    ("usuarios",              "sesiones",                    "1N", "genera"),
    ("usuarios",              "usuarios_roles",              "NN", "tiene roles"),   # pivot
    ("roles",                 "usuarios_roles",              "NN", "asignado a"),    # pivot
    ("roles",                 "roles_permisos",              "NN", "contiene"),      # pivot
    ("permisos",              "roles_permisos",              "NN", "asignado en"),   # pivot

    # ── Módulo 2: Configuración del Sitio ────────────────────────────────────
    ("menus",                 "menu_items",                  "1N", "contiene"),
    ("menu_items",            "menu_items",                  "1N", "sub-item"),      # auto-ref

    # ── Módulo 3: Autoridades e Institucional ────────────────────────────────
    ("secretarias",           "autoridades",                 "1N", "tiene"),
    ("secretarias",           "organigrama",                 "1N", "representa"),
    ("organigrama",           "organigrama",                 "1N", "depende de"),   # auto-ref
    ("secretarias",           "unidades_responsables",       "1N", "tiene"),

    # ── Módulo 4: Noticias y Comunicados ─────────────────────────────────────
    ("categorias_noticia",    "noticias",                    "1N", "clasifica"),
    ("usuarios",              "noticias",                    "1N", "redacta"),
    ("noticias",              "noticias_etiquetas",          "NN", "tiene"),         # pivot
    ("etiquetas",             "noticias_etiquetas",          "NN", "aplicada en"),   # pivot
    ("noticias",              "multimedia",                  "1N", "galería"),
    ("comunicados",           "multimedia",                  "1N", "adjunta"),
    ("usuarios",              "comunicados",                 "1N", "publica"),

    # ── Módulo 5: Agenda ─────────────────────────────────────────────────────
    ("tipos_evento",          "eventos",                     "1N", "clasifica"),
    ("usuarios",              "eventos",                     "1N", "crea"),

    # ── Módulo 6: Normativa ──────────────────────────────────────────────────
    ("tipos_norma",           "normas",                      "1N", "clasifica"),

    # ── Módulo 7: Trámites y Servicios ───────────────────────────────────────
    ("unidades_responsables", "tramites_catalogo",           "1N", "gestiona"),
    ("tipos_tramite",         "tramites_catalogo",           "1N", "clasifica"),
    ("tramites_catalogo",     "requisitos_tramite",          "1N", "requiere"),
    ("tramites_catalogo",     "formularios_tramite",         "1N", "incluye"),

    # ── Módulo 8: POA y Presupuesto ──────────────────────────────────────────
    ("planes_gobierno",       "poa",                         "1N", "origina"),
    ("secretarias",           "poa",                         "1N", "ejecuta"),
    ("poa",                   "programas_poa",               "1N", "contiene"),
    ("secretarias",           "presupuestos",                "1N", "asignado a"),
    ("presupuestos",          "partidas_presupuestarias",    "1N", "desglosa"),
    ("partidas_presupuestarias","ejecucion_presupuestaria",  "1N", "registra"),

    # ── Módulo 9: Gobierno Abierto y Transparencia ───────────────────────────
    ("categorias_indicador",  "indicadores_gestion",         "1N", "agrupa"),
    ("indicadores_gestion",   "valores_indicador",           "1N", "registra valor"),
    ("tipos_documento_transparencia","documentos_transparencia","1N","clasifica"),
    ("secretarias",           "documentos_transparencia",    "1N", "publica"),

    # ── Módulo 10: Participación Ciudadana ───────────────────────────────────
    ("eventos",               "audiencias_publicas",         "1N", "genera"),
    ("secretarias",           "audiencias_publicas",         "1N", "organiza"),
    ("consultas_ciudadanas",  "opciones_consulta",           "1N", "tiene"),
    ("opciones_consulta",     "votos_consulta",              "1N", "recibe"),
    ("usuarios",              "votos_consulta",              "1N", "emite"),
    ("usuarios",              "sugerencias",                 "1N", "envía"),
    ("secretarias",           "sugerencias",                 "1N", "destino"),

    # ── Módulo 11: Solicitudes de Información Pública ────────────────────────
    ("usuarios",              "solicitudes_informacion",     "1N", "solicita"),
    ("secretarias",           "solicitudes_informacion",     "1N", "destino"),
    ("solicitudes_informacion","respuestas_informacion",     "1N", "recibe"),

    # ── Módulo 12: Contacto y Directorio ─────────────────────────────────────
    ("secretarias",           "directorio_institucional",    "1N", "tiene"),
    ("subcenefcos",          "directorio_institucional",    "1N", "tiene"),
    ("secretarias",           "mensajes_contacto",           "1N", "recibe"),

    # ── Módulo 14: Recursos Humanos ──────────────────────────────────────────
    ("secretarias",           "nomina_personal",             "1N", "tiene personal"),
    ("usuarios",              "nomina_personal",             "1N", "vinculado a"),

    # ── Módulo 15: Contenido Institucional ───────────────────────────────────
    ("plan_estrategico_institucional","ejes_pei",            "1N", "contiene"),

    # ── Módulo 16: Auditorías ────────────────────────────────────────────────
    ("tipos_auditoria",       "auditorias",                  "1N", "clasifica"),
    ("secretarias",           "auditorias",                  "1N", "auditada"),
    ("auditorias",            "hallazgos_auditoria",         "1N", "genera"),
    ("secretarias",           "hallazgos_auditoria",         "1N", "responsable"),
]

# Estilos de flecha ERD por tipo de relación
# Sin exitX/entryX → draw.io auto-rutea las líneas alrededor de las tablas
EDGE_STYLES = {
    # 1:N — gris oscuro, | en origen, crow's foot en destino
    "1N": (
        "edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;"
        "jettySize=auto;html=1;"
        "startArrow=ERmandOne;startFill=0;startSize=8;"
        "endArrow=ERmany;endFill=0;endSize=8;"
        "strokeWidth=1.5;strokeColor=#444444;"
        "labelBackgroundColor=#ffffff;fontSize=10;"
    ),
    # hacia tabla pivot (N:M implícito) — naranja punteado
    "NN": (
        "edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;"
        "jettySize=auto;html=1;"
        "startArrow=ERmandOne;startFill=0;startSize=8;"
        "endArrow=ERmany;endFill=0;endSize=8;"
        "strokeWidth=1.5;strokeColor=#cc6600;dashed=1;dashPattern=8 4;"
        "labelBackgroundColor=#ffffff;fontSize=10;"
    ),
    # 1:1 — azul
    "11": (
        "edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;"
        "jettySize=auto;html=1;"
        "startArrow=ERmandOne;startFill=0;startSize=8;"
        "endArrow=ERmandOne;endFill=0;endSize=8;"
        "strokeWidth=1.5;strokeColor=#0066cc;"
        "labelBackgroundColor=#ffffff;fontSize=10;"
    ),
}

# ─── COLORES POR TIPO DE CLAVE ────────────────────────────────────────────────
KEY_STYLE = {
    "PK": "fontStyle=1;fillColor=#fff2cc;strokeColor=#d6b656;",
    "FK": "fontStyle=0;fillColor=#f8cecc;strokeColor=#b85450;",
    "UK": "fontStyle=2;fillColor=#d5e8d4;strokeColor=#82b366;",
    "":   "fontStyle=0;fillColor=none;strokeColor=none;",
}

ROW_H    = 24
HEADER_H = 32
COL_W    = 280   # tablas más anchas
KEY_W    = 36

# ─── GENERACIÓN DEL XML ───────────────────────────────────────────────────────

def hex_to_rgb(h):
    h = h.lstrip('#')
    return tuple(int(h[i:i+2], 16) for i in (0, 2, 4))

def lighten(hex_color, factor=0.85):
    r, g, b = hex_to_rgb(hex_color)
    r2 = int(r + (255 - r) * factor)
    g2 = int(g + (255 - g) * factor)
    b2 = int(b + (255 - b) * factor)
    return f"#{r2:02x}{g2:02x}{b2:02x}"

def build_drawio():
    root = ET.Element("mxGraphModel",
        dx="1422", dy="762", grid="1", gridSize="10",
        guides="1", tooltips="1", connect="1", arrows="1",
        fold="1", page="0", pageScale="1",
        pageWidth="16000", pageHeight="12000",
        math="0", shadow="0"
    )
    parent_el = ET.SubElement(root, "root")
    ET.SubElement(parent_el, "mxCell", id="0")
    ET.SubElement(parent_el, "mxCell", id="1", parent="0")

    cell_id   = 2
    table_ids = {}   # tabla_name → id del contenedor (para edges)

    COLS        = 3      # 3 módulos por fila → más espacio horizontal
    MOD_PADDING = 400    # espacio entre módulos para que las flechas pasen limpio
    TABLE_GAP   = 40     # espacio entre tablas dentro del módulo
    START_X     = 40
    START_Y     = 40

    # Calcular altura de cada módulo
    mod_heights = []
    for mod in MODULOS:
        total_h = 50
        for _, cols in mod["tablas"]:
            total_h += HEADER_H + ROW_H * len(cols) + TABLE_GAP
        mod_heights.append(total_h)

    rows = [MODULOS[i:i+COLS] for i in range(0, len(MODULOS), COLS)]
    row_heights = []
    for ri, row in enumerate(rows):
        idxs = range(ri * COLS, min(ri * COLS + COLS, len(MODULOS)))
        row_heights.append(max(mod_heights[i] for i in idxs))

    cur_y = START_Y
    for ri, row in enumerate(rows):
        cur_x = START_X
        for mod in row:
            header_color = mod["color_header"]

            # Etiqueta del módulo
            mod_label_id = str(cell_id); cell_id += 1
            lbl = ET.SubElement(parent_el, "mxCell",
                id=mod_label_id,
                value=f"<b>{mod['nombre']}</b>",
                style=(
                    f"text;html=1;strokeColor=none;fillColor={header_color};"
                    "align=center;verticalAlign=middle;whiteSpace=wrap;"
                    "rounded=1;fontSize=13;fontColor=#ffffff;fontStyle=1;"
                ),
                vertex="1", parent="1"
            )
            ET.SubElement(lbl, "mxGeometry",
                x=str(cur_x), y=str(cur_y),
                width=str(COL_W), height="30",
                **{"as": "geometry"}
            )

            table_y = cur_y + 40
            for tabla_name, cols in mod["tablas"]:
                total_h = HEADER_H + ROW_H * len(cols)

                # ID nombrado por tabla para poder conectar edges
                tbl_id = f"tbl_{tabla_name}"
                table_ids[tabla_name] = tbl_id

                tbl_cell = ET.SubElement(parent_el, "mxCell",
                    id=tbl_id,
                    value=f"<b>{tabla_name}</b>",
                    style=(
                        f"shape=table;startSize={HEADER_H};container=1;"
                        "collapsible=0;childLayout=tableLayout;fixedRows=1;"
                        "rowLines=0;fontStyle=1;align=center;resizeLast=1;"
                        f"fontSize=12;fillColor={lighten(header_color, 0.6)};"
                        f"strokeColor={header_color};fontColor=#000000;"
                        "swimlaneLine=1;"
                    ),
                    vertex="1", parent="1"
                )
                ET.SubElement(tbl_cell, "mxGeometry",
                    x=str(cur_x), y=str(table_y),
                    width=str(COL_W), height=str(total_h),
                    **{"as": "geometry"}
                )

                for ri2, (col_name, col_type, key) in enumerate(cols):
                    row_id  = str(cell_id); cell_id += 1
                    key_id  = str(cell_id); cell_id += 1
                    name_id = str(cell_id); cell_id += 1

                    row_y   = HEADER_H + ROW_H * ri2
                    is_last = (ri2 == len(cols) - 1)

                    row_cell = ET.SubElement(parent_el, "mxCell",
                        id=row_id, value="",
                        style=(
                            "shape=tableRow;horizontal=0;startSize=0;"
                            "swimlaneHead=0;swimlaneBody=0;fillColor=none;"
                            "collapsible=0;dropTarget=0;"
                            "points=[[0,0.5],[1,0.5]];"
                            "portConstraint=eastwest;fontSize=11;"
                            f"top=0;left=0;right=0;bottom={'0' if is_last else '1'};"
                        ),
                        vertex="1", parent=tbl_id
                    )
                    ET.SubElement(row_cell, "mxGeometry",
                        y=str(row_y),
                        width=str(COL_W), height=str(ROW_H),
                        **{"as": "geometry"}
                    )

                    key_cell = ET.SubElement(parent_el, "mxCell",
                        id=key_id, value=key,
                        style=(
                            "shape=partialRectangle;connectable=0;"
                            f"{KEY_STYLE.get(key, KEY_STYLE[''])};"
                            "top=0;left=0;bottom=0;right=0;"
                            f"fontStyle={'1' if key == 'PK' else '0'};"
                            "fontSize=9;overflow=hidden;align=center;"
                        ),
                        vertex="1", connectable="0", parent=row_id
                    )
                    key_geo = ET.SubElement(key_cell, "mxGeometry",
                        width=str(KEY_W), height=str(ROW_H),
                        **{"as": "geometry"}
                    )
                    ET.SubElement(key_geo, "mxRectangle",
                        width=str(KEY_W), height=str(ROW_H),
                        **{"as": "alternateBounds"}
                    )

                    name_cell = ET.SubElement(parent_el, "mxCell",
                        id=name_id,
                        value=f"{col_name} : {col_type}",
                        style=(
                            "shape=partialRectangle;connectable=0;"
                            "fillColor=none;strokeColor=none;"
                            "top=0;left=0;bottom=0;right=0;"
                            "fontSize=11;overflow=hidden;align=left;spacingLeft=4;"
                        ),
                        vertex="1", connectable="0", parent=row_id
                    )
                    name_geo = ET.SubElement(name_cell, "mxGeometry",
                        x=str(KEY_W),
                        width=str(COL_W - KEY_W), height=str(ROW_H),
                        **{"as": "geometry"}
                    )
                    ET.SubElement(name_geo, "mxRectangle",
                        width=str(COL_W - KEY_W), height=str(ROW_H),
                        **{"as": "alternateBounds"}
                    )

                table_y += total_h + TABLE_GAP

            cur_x += COL_W + MOD_PADDING

        cur_y += row_heights[ri] + 300   # espacio vertical entre filas de módulos

    return root

def main():
    root = build_drawio()
    tree = ET.ElementTree(root)
    ET.indent(tree, space="  ")
    out = "/home/alfredynho/Downloads/achocalla/Current-Angular_v1.0/docs/cenefco_bd.drawio"
    tree.write(out, encoding="utf-8", xml_declaration=True)
    print(f"✅ Archivo generado: {out}")

    # Contar tablas y celdas generadas
    cells = root.findall(".//mxCell")
    print(f"   Celdas generadas: {len(cells)}")

if __name__ == "__main__":
    main()
