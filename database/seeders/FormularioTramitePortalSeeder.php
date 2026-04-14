<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormularioTramitePortalSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $formularios = [
            // ── Certificado de Domicilio ────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Certificado de Domicilio',
                'titulo'         => 'Solicitud de Certificado de Domicilio',
                'descripcion'    => 'Formulario oficial para solicitar el certificado de domicilio ante la Alcaldía Municipal. Debe ser llenado con datos del solicitante y presentado junto a la documentación requerida.',
                'version'        => 'v2.1 - 2025',
                'archivo_url'    => '/storage/formularios/solicitud-certificado-domicilio.pdf',
                'archivo_nombre' => 'solicitud-certificado-domicilio.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Certificado de Domicilio',
                'titulo'         => 'Declaración Jurada de Residencia',
                'descripcion'    => 'Documento complementario al certificado de domicilio. Declaración jurada firmada por el solicitante y dos testigos que acrediten la residencia en el municipio.',
                'version'        => 'v1.3 - 2025',
                'archivo_url'    => '/storage/formularios/declaracion-jurada-residencia.pdf',
                'archivo_nombre' => 'declaracion-jurada-residencia.pdf',
                'orden'          => 2,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Certificado de Soltería ─────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Certificado de Soltería',
                'titulo'         => 'Solicitud de Certificado de Soltería',
                'descripcion'    => 'Formulario para solicitar el certificado de estado civil (soltería) emitido por el Registro Civil Municipal.',
                'version'        => 'v1.0 - 2025',
                'archivo_url'    => '/storage/formularios/solicitud-certificado-solteria.pdf',
                'archivo_nombre' => 'solicitud-certificado-solteria.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Registro Ciudadano ──────────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Registro Ciudadano',
                'titulo'         => 'Formulario de Registro Ciudadano',
                'descripcion'    => 'Formulario de inscripción al padrón de ciudadanos del municipio. Requerido para acceder a servicios municipales, licencias y beneficios sociales.',
                'version'        => 'v3.0 - 2026',
                'archivo_url'    => '/storage/formularios/formulario-registro-ciudadano.pdf',
                'archivo_nombre' => 'formulario-registro-ciudadano.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Registro Ciudadano',
                'titulo'         => 'Actualización de Datos Ciudadanos',
                'descripcion'    => 'Formulario para actualizar información personal en el padrón municipal: domicilio, teléfono, datos familiares y actividad económica.',
                'version'        => 'v2.0 - 2026',
                'archivo_url'    => '/storage/formularios/actualizacion-datos-ciudadanos.pdf',
                'archivo_nombre' => 'actualizacion-datos-ciudadanos.pdf',
                'orden'          => 2,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Licencia de Funcionamiento ──────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Licencia de Funcionamiento',
                'titulo'         => 'Solicitud de Licencia de Funcionamiento Comercial',
                'descripcion'    => 'Formulario para obtener la licencia de funcionamiento para establecimientos comerciales, industriales y de servicios dentro del municipio.',
                'version'        => 'v4.2 - 2026',
                'archivo_url'    => '/storage/formularios/solicitud-licencia-funcionamiento.pdf',
                'archivo_nombre' => 'solicitud-licencia-funcionamiento.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Licencia de Funcionamiento',
                'titulo'         => 'Renovación de Licencia de Funcionamiento',
                'descripcion'    => 'Formulario para renovar anualmente la licencia de funcionamiento. Incluye declaración de actividades, número de empleados y datos del establecimiento.',
                'version'        => 'v3.1 - 2026',
                'archivo_url'    => '/storage/formularios/renovacion-licencia-funcionamiento.pdf',
                'archivo_nombre' => 'renovacion-licencia-funcionamiento.pdf',
                'orden'          => 2,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Licencia de Funcionamiento',
                'titulo'         => 'Declaración Jurada de Actividad Económica',
                'descripcion'    => 'Declaración jurada complementaria a la licencia de funcionamiento. Detalla el giro comercial, horario de atención y cumplimiento de normas sanitarias.',
                'version'        => 'v1.5 - 2025',
                'archivo_url'    => '/storage/formularios/declaracion-jurada-actividad-economica.pdf',
                'archivo_nombre' => 'declaracion-jurada-actividad-economica.pdf',
                'orden'          => 3,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Permiso de Construcción ─────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Permiso de Construcción',
                'titulo'         => 'Solicitud de Permiso de Construcción',
                'descripcion'    => 'Formulario para solicitar el permiso de construcción de obras nuevas, ampliaciones o remodelaciones dentro del municipio. Adjuntar planos aprobados.',
                'version'        => 'v5.0 - 2026',
                'archivo_url'    => '/storage/formularios/solicitud-permiso-construccion.pdf',
                'archivo_nombre' => 'solicitud-permiso-construccion.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Permiso de Construcción',
                'titulo'         => 'Memoria Descriptiva de Obra',
                'descripcion'    => 'Formulario para describir las características técnicas de la obra: materiales, superficie, número de plantas, uso del inmueble y datos del profesional responsable.',
                'version'        => 'v2.0 - 2025',
                'archivo_url'    => '/storage/formularios/memoria-descriptiva-obra.pdf',
                'archivo_nombre' => 'memoria-descriptiva-obra.pdf',
                'orden'          => 2,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Servicios Básicos ───────────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Solicitud de Agua Potable',
                'titulo'         => 'Solicitud de Conexión de Agua Potable',
                'descripcion'    => 'Formulario para solicitar la conexión al servicio de agua potable para inmuebles dentro del área de cobertura municipal.',
                'version'        => 'v2.3 - 2025',
                'archivo_url'    => '/storage/formularios/solicitud-conexion-agua-potable.pdf',
                'archivo_nombre' => 'solicitud-conexion-agua-potable.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Solicitud de Alcantarillado',
                'titulo'         => 'Solicitud de Conexión a Red de Alcantarillado',
                'descripcion'    => 'Formulario para solicitar la conexión al sistema de alcantarillado sanitario. Incluye datos del inmueble y responsable del trámite.',
                'version'        => 'v1.8 - 2025',
                'archivo_url'    => '/storage/formularios/solicitud-conexion-alcantarillado.pdf',
                'archivo_nombre' => 'solicitud-conexion-alcantarillado.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Reclamo de Servicio de Agua',
                'titulo'         => 'Formulario de Reclamo por Servicio de Agua Potable',
                'descripcion'    => 'Formulario para presentar reclamos relacionados con el servicio de agua potable: cortes no programados, presión inadecuada, cobros incorrectos u otros.',
                'version'        => 'v1.2 - 2025',
                'archivo_url'    => '/storage/formularios/reclamo-servicio-agua.pdf',
                'archivo_nombre' => 'reclamo-servicio-agua.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Alumbrado Público ───────────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Reporte de Alumbrado Público',
                'titulo'         => 'Formulario de Reporte de Falla en Alumbrado Público',
                'descripcion'    => 'Formulario para reportar lámparas o postes de alumbrado público dañados, apagados o en mal estado. Incluir dirección exacta y referencia del lugar.',
                'version'        => 'v2.0 - 2025',
                'archivo_url'    => '/storage/formularios/reporte-alumbrado-publico.pdf',
                'archivo_nombre' => 'reporte-alumbrado-publico.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Reclamos y Denuncias ────────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Reclamo Ciudadano',
                'titulo'         => 'Formulario de Reclamo Ciudadano',
                'descripcion'    => 'Formulario general para presentar reclamos relacionados con servicios municipales: mantenimiento vial, limpieza pública, parques, mercados y otros servicios.',
                'version'        => 'v3.0 - 2026',
                'archivo_url'    => '/storage/formularios/formulario-reclamo-ciudadano.pdf',
                'archivo_nombre' => 'formulario-reclamo-ciudadano.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Denuncia Ciudadana',
                'titulo'         => 'Formulario de Denuncia por Incumplimiento Municipal',
                'descripcion'    => 'Formulario para presentar denuncias sobre incumplimiento de normativas municipales, construcciones ilegales, contaminación ambiental u otras infracciones.',
                'version'        => 'v2.1 - 2026',
                'archivo_url'    => '/storage/formularios/formulario-denuncia-ciudadana.pdf',
                'archivo_nombre' => 'formulario-denuncia-ciudadana.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Unidades Sociales ───────────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Asistencia Social - Mujer',
                'titulo'         => 'Solicitud de Atención a la Mujer y Familia',
                'descripcion'    => 'Formulario de solicitud de atención psicológica, legal y social para mujeres en situación de vulnerabilidad. La información es estrictamente confidencial.',
                'version'        => 'v2.5 - 2026',
                'archivo_url'    => '/storage/formularios/solicitud-atencion-mujer-familia.pdf',
                'archivo_nombre' => 'solicitud-atencion-mujer-familia.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Asistencia Social - Adulto Mayor',
                'titulo'         => 'Solicitud de Atención al Adulto Mayor',
                'descripcion'    => 'Formulario para solicitar servicios de atención al adulto mayor: asistencia médica básica, programas recreativos, asesoría legal y apoyo social.',
                'version'        => 'v1.7 - 2025',
                'archivo_url'    => '/storage/formularios/solicitud-atencion-adulto-mayor.pdf',
                'archivo_nombre' => 'solicitud-atencion-adulto-mayor.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Asistencia Social - Personas con Discapacidad',
                'titulo'         => 'Solicitud de Apoyo a Personas con Discapacidad',
                'descripcion'    => 'Formulario para solicitar apoyo y beneficios municipales destinados a personas con discapacidad: carnet de discapacidad, beneficios de ley, equipamiento y otros.',
                'version'        => 'v1.4 - 2025',
                'archivo_url'    => '/storage/formularios/solicitud-apoyo-discapacidad.pdf',
                'archivo_nombre' => 'solicitud-apoyo-discapacidad.pdf',
                'orden'          => 2,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Impuestos y Tasas ───────────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Pago de Impuesto a la Propiedad',
                'titulo'         => 'Formulario de Declaración de Inmueble',
                'descripcion'    => 'Formulario para la declaración y valuación de inmuebles a efectos del impuesto a la propiedad inmueble (IPBI). Incluir datos catastrales y características del bien.',
                'version'        => 'v4.0 - 2026',
                'archivo_url'    => '/storage/formularios/declaracion-inmueble-ipbi.pdf',
                'archivo_nombre' => 'declaracion-inmueble-ipbi.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Pago de Impuesto a la Propiedad',
                'titulo'         => 'Solicitud de Fraccionamiento de Deuda Municipal',
                'descripcion'    => 'Formulario para solicitar el fraccionamiento o plan de pagos de deudas por impuestos municipales vencidos. Adjuntar documentación del inmueble.',
                'version'        => 'v2.0 - 2026',
                'archivo_url'    => '/storage/formularios/solicitud-fraccionamiento-deuda.pdf',
                'archivo_nombre' => 'solicitud-fraccionamiento-deuda.pdf',
                'orden'          => 2,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Catastro ────────────────────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Levantamiento Catastral',
                'titulo'         => 'Solicitud de Levantamiento Catastral de Inmueble',
                'descripcion'    => 'Formulario para solicitar el levantamiento y registro catastral de un inmueble. Requerido para obtener el número de folio catastral y certificado catastral.',
                'version'        => 'v3.2 - 2025',
                'archivo_url'    => '/storage/formularios/solicitud-levantamiento-catastral.pdf',
                'archivo_nombre' => 'solicitud-levantamiento-catastral.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Certificado Catastral',
                'titulo'         => 'Solicitud de Certificado Catastral',
                'descripcion'    => 'Formulario para obtener el certificado catastral del inmueble con datos de ubicación, superficie, colindancias y valor catastral.',
                'version'        => 'v2.8 - 2026',
                'archivo_url'    => '/storage/formularios/solicitud-certificado-catastral.pdf',
                'archivo_nombre' => 'solicitud-certificado-catastral.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Mercados y Ferias ───────────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Asignación de Puesto en Mercado',
                'titulo'         => 'Solicitud de Asignación de Puesto en Mercado Municipal',
                'descripcion'    => 'Formulario para solicitar la asignación o transferencia de puesto en mercados municipales. Incluye datos del solicitante, tipo de actividad comercial y puesto requerido.',
                'version'        => 'v1.6 - 2025',
                'archivo_url'    => '/storage/formularios/solicitud-puesto-mercado.pdf',
                'archivo_nombre' => 'solicitud-puesto-mercado.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],

            // ── Medio Ambiente ──────────────────────────────────────────────
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Licencia Ambiental Municipal',
                'titulo'         => 'Solicitud de Licencia Ambiental Municipal',
                'descripcion'    => 'Formulario para obtener la licencia ambiental municipal para actividades que puedan generar impacto en el medio ambiente: construcciones, industrias, eventos masivos.',
                'version'        => 'v2.4 - 2026',
                'archivo_url'    => '/storage/formularios/solicitud-licencia-ambiental.pdf',
                'archivo_nombre' => 'solicitud-licencia-ambiental.pdf',
                'orden'          => 1,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
            [
                'tramite_id'     => null,
                'tramite_nombre' => 'Licencia Ambiental Municipal',
                'titulo'         => 'Declaratoria de Impacto Ambiental',
                'descripcion'    => 'Formulario de declaratoria de impacto ambiental para proyectos de mediana envergadura. Complementa la solicitud de licencia ambiental municipal.',
                'version'        => 'v1.0 - 2025',
                'archivo_url'    => '/storage/formularios/declaratoria-impacto-ambiental.pdf',
                'archivo_nombre' => 'declaratoria-impacto-ambiental.pdf',
                'orden'          => 2,
                'vigente'        => 1,
                'publicado'      => 1,
            ],
        ];

        foreach ($formularios as &$f) {
            $f['created_at'] = $now;
            $f['updated_at'] = $now;
        }

        DB::table('formularios_tramite_portal')->insert($formularios);
    }
}
