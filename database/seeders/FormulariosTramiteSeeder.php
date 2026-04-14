<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormulariosTramiteSeeder extends Seeder
{
    public function run(): void
    {
        $base = 'https://senefco.gob.bo/formularios/';

        $formulariosPorTramite = [
            'Actualización de Datos Catastrales' => [
                ['nombre' => 'Guía de Actualización Catastral', 'archivo_url' => $base.'guia-actualizacion-catastral.pdf', 'formato' => 'PDF', 'fecha_actualizacion' => '2025-01-01', 'activo' => true],
            ],
            'Renovación de Licencia de Funcionamiento' => [
                ['nombre' => 'Formulario de Renovación de Licencia', 'archivo_url' => $base.'renovacion-licencia.pdf', 'formato' => 'PDF', 'fecha_actualizacion' => '2025-01-01', 'activo' => true],
            ],
            'Atención a Víctimas de Violencia Intrafamiliar' => [
                ['nombre' => 'Formulario de Denuncia SLIM',          'archivo_url' => $base.'denuncia-slim.pdf',                   'formato' => 'PDF', 'fecha_actualizacion' => '2025-01-01', 'activo' => true],
                ['nombre' => 'Protocolo de Atención a Víctimas',     'archivo_url' => $base.'protocolo-atencion-victimas.pdf',     'formato' => 'PDF', 'fecha_actualizacion' => '2025-01-01', 'activo' => true],
            ],
            'Solicitud de Servicio de Recolección de Residuos Especiales' => [
                ['nombre' => 'Solicitud de Recolección de Residuos Especiales', 'archivo_url' => $base.'solicitud-residuos-especiales.pdf', 'formato' => 'PDF', 'fecha_actualizacion' => '2025-01-01', 'activo' => true],
            ],
            'Visado de Planos' => [
                ['nombre' => 'Instructivo para Visado de Planos',  'archivo_url' => $base.'instructivo-visado-planos.pdf',      'formato' => 'PDF',  'fecha_actualizacion' => '2025-01-01', 'activo' => true],
                ['nombre' => 'Plantilla de Memoria Descriptiva',   'archivo_url' => $base.'plantilla-memoria-descriptiva.docx', 'formato' => 'DOCX', 'fecha_actualizacion' => '2025-01-01', 'activo' => true],
            ],
            'Certificado de Aptitud Sanitaria' => [
                ['nombre' => 'Formulario de Inspección Sanitaria', 'archivo_url' => $base.'inspeccion-sanitaria.pdf', 'formato' => 'PDF', 'fecha_actualizacion' => '2025-01-01', 'activo' => true],
            ],
        ];

        foreach ($formulariosPorTramite as $nombreTramite => $formularios) {
            $tramite = DB::table('tramites_catalogo')->where('nombre', $nombreTramite)->first();

            if (! $tramite) {
                continue;
            }

            foreach ($formularios as $formulario) {
                DB::table('formularios_tramite')->insert(array_merge(
                    ['tramite_id' => $tramite->id],
                    $formulario
                ));
            }
        }
    }
}
