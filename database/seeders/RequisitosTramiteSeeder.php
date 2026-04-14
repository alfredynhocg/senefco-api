<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequisitosTramiteSeeder extends Seeder
{
    public function run(): void
    {
        $requisitos = [
            4 => [
                ['nombre' => 'Licencia de funcionamiento anterior', 'obligatorio' => true,  'tipo' => 'documento',  'orden' => 1],
                ['nombre' => 'NIT actualizado vigente',              'obligatorio' => true,  'tipo' => 'documento',  'orden' => 2],
                ['nombre' => 'Carnet de identidad del titular',      'obligatorio' => true,  'tipo' => 'documento',  'orden' => 3],
                ['nombre' => 'Formulario de renovación',             'obligatorio' => true,  'tipo' => 'formulario', 'orden' => 4],
            ],
            5 => [
                ['nombre' => 'Carnet de identidad de la madre',           'obligatorio' => true,  'tipo' => 'documento',  'orden' => 1],
                ['nombre' => 'Certificado de nacimiento del menor',        'obligatorio' => true,  'tipo' => 'documento',  'orden' => 2],
                ['nombre' => 'Constancia médica de lactancia',             'obligatorio' => true,  'tipo' => 'documento',  'orden' => 3],
                ['nombre' => 'Formulario de solicitud de subsidio',        'obligatorio' => true,  'tipo' => 'formulario', 'orden' => 4],
                ['nombre' => 'Certificado de control de crecimiento (SNIS)', 'obligatorio' => false, 'tipo' => 'documento',  'orden' => 5],
            ],
            6 => [
                ['nombre' => 'Carnet de identidad',             'obligatorio' => true,  'tipo' => 'documento',  'orden' => 1],
                ['nombre' => 'Denuncia verbal o escrita',       'obligatorio' => false, 'tipo' => 'otro',       'orden' => 2],
                ['nombre' => 'Informe médico forense (si hay)', 'obligatorio' => false, 'tipo' => 'documento',  'orden' => 3],
            ],
            7 => [
                ['nombre' => 'Formulario FA-1 llenado',                           'obligatorio' => true,  'tipo' => 'formulario', 'orden' => 1],
                ['nombre' => 'Estudio de Evaluación de Impacto Ambiental (EEIA)', 'obligatorio' => true,  'tipo' => 'documento',  'orden' => 2],
                ['nombre' => 'NIT de la empresa',                                  'obligatorio' => true,  'tipo' => 'documento',  'orden' => 3],
                ['nombre' => 'Plano de ubicación del proyecto',                    'obligatorio' => true,  'tipo' => 'plano',      'orden' => 4],
                ['nombre' => 'Memoria descriptiva del proyecto',                   'obligatorio' => true,  'tipo' => 'documento',  'orden' => 5],
                ['nombre' => 'Informe de medidas de mitigación',                   'obligatorio' => false, 'tipo' => 'documento',  'orden' => 6],
            ],
            8 => [
                ['nombre' => 'Carnet de identidad del solicitante', 'obligatorio' => true,  'tipo' => 'documento',  'orden' => 1],
                ['nombre' => 'Descripción del tipo de residuo',     'obligatorio' => true,  'tipo' => 'otro',       'orden' => 2],
                ['nombre' => 'Dirección exacta de recolección',     'obligatorio' => true,  'tipo' => 'otro',       'orden' => 3],
                ['nombre' => 'Formulario de solicitud',             'obligatorio' => true,  'tipo' => 'formulario', 'orden' => 4],
            ],
            10 => [
                ['nombre' => 'Planos en formato digital (DWG/PDF)', 'obligatorio' => true,  'tipo' => 'plano',     'orden' => 1],
                ['nombre' => 'Planos impresos (3 juegos)',           'obligatorio' => true,  'tipo' => 'plano',     'orden' => 2],
                ['nombre' => 'Certificado catastral vigente',        'obligatorio' => true,  'tipo' => 'documento', 'orden' => 3],
                ['nombre' => 'Carnet del profesional responsable',   'obligatorio' => true,  'tipo' => 'documento', 'orden' => 4],
                ['nombre' => 'Memoria descriptiva',                  'obligatorio' => false, 'tipo' => 'documento', 'orden' => 5],
            ],
            12 => [
                ['nombre' => 'Carnet de identidad del propietario',         'obligatorio' => true,  'tipo' => 'documento',  'orden' => 1],
                ['nombre' => 'Licencia de funcionamiento vigente',           'obligatorio' => true,  'tipo' => 'documento',  'orden' => 2],
                ['nombre' => 'Carnet de manipulación de alimentos del personal', 'obligatorio' => true, 'tipo' => 'documento', 'orden' => 3],
                ['nombre' => 'Formulario de solicitud de inspección',        'obligatorio' => true,  'tipo' => 'formulario', 'orden' => 4],
                ['nombre' => 'Fotografías del establecimiento',              'obligatorio' => false, 'tipo' => 'otro',       'orden' => 5],
            ],
            13 => [
                ['nombre' => 'Carnet de identidad del estudiante',   'obligatorio' => true,  'tipo' => 'documento',  'orden' => 1],
                ['nombre' => 'Certificado de calificaciones',         'obligatorio' => true,  'tipo' => 'documento',  'orden' => 2],
                ['nombre' => 'Certificado de ingresos familiares',    'obligatorio' => true,  'tipo' => 'documento',  'orden' => 3],
                ['nombre' => 'Carnet de estudiante o constancia',     'obligatorio' => true,  'tipo' => 'documento',  'orden' => 4],
                ['nombre' => 'Formulario de solicitud de beca',       'obligatorio' => true,  'tipo' => 'formulario', 'orden' => 5],
                ['nombre' => 'Carta de recomendación del docente',    'obligatorio' => false, 'tipo' => 'documento',  'orden' => 6],
            ],
            14 => [
                ['nombre' => 'Certificado hospitalario de nacimiento',        'obligatorio' => true,  'tipo' => 'documento',  'orden' => 1],
                ['nombre' => 'Carnet de identidad del padre',                 'obligatorio' => true,  'tipo' => 'documento',  'orden' => 2],
                ['nombre' => 'Carnet de identidad de la madre',               'obligatorio' => true,  'tipo' => 'documento',  'orden' => 3],
                ['nombre' => 'Libreta de matrimonio (si corresponde)',         'obligatorio' => false, 'tipo' => 'documento',  'orden' => 4],
                ['nombre' => 'Formulario de inscripción de nacimiento',        'obligatorio' => true,  'tipo' => 'formulario', 'orden' => 5],
            ],
        ];

        foreach ($requisitos as $tramiteId => $lista) {
            foreach ($lista as $req) {
                DB::table('requisitos_tramite')->insert(array_merge(
                    ['tramite_id' => $tramiteId],
                    $req
                ));
            }
        }
    }
}
