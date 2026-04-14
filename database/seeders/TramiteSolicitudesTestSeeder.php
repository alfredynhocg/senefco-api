<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TramiteSolicitudesTestSeeder extends Seeder
{
    public function run(): void
    {
        $tramites = DB::table('tramites_catalogo')
            ->whereIn('nombre', [
                'Certificado de Domicilio',
                'Constancia de Residencia',
                'Solicitud de Alumbrado Público',
                'Denuncia por Basura Acumulada',
                'Atención en SLIM - Unidad de la Mujer',
                'Atención para Adulto Mayor',
                'Denuncia de Construcción Ilegal',
            ])
            ->pluck('id', 'nombre');

        if ($tramites->isEmpty()) {
            $this->command->warn('No se encontraron tramites con seguimiento. Ejecuta TramitesConSeguimientoSeeder primero.');
            return;
        }

        $ciudadanos = [
            ['nombre' => 'María Elena Quispe Mamani',  'ci' => '5821034',  'phone' => '59179801234'],
            ['nombre' => 'Juan Carlos Flores Ticona',  'ci' => '7234591',  'phone' => '59176543210'],
            ['nombre' => 'Rosa Condori de Huanca',     'ci' => '4512367',  'phone' => '59172109876'],
            ['nombre' => 'Pedro Mamani Apaza',         'ci' => '6789023',  'phone' => '59178765432'],
            ['nombre' => 'Carmen Llanos Vargas',       'ci' => '3456789',  'phone' => '59171234567'],
            ['nombre' => 'Luis Alberto Chura Poma',    'ci' => '8901234',  'phone' => '59177654321'],
            ['nombre' => 'Ana Beatriz Quispe López',   'ci' => '2345678',  'phone' => '59175432198'],
            ['nombre' => 'Roberto Mamani Callisaya',   'ci' => '9012345',  'phone' => '59173219876'],
        ];

        $solicitudes = [
            [
                'tramite'  => 'Certificado de Domicilio',
                'ciudadano'=> 0,
                'etapa'    => 1,
                'estado'   => 'en_proceso',
                'dias'     => 0,
                'historial'=> [
                    [1, 'Recepción y Registro', 'Solicitud registrada vía WhatsApp.'],
                ],
            ],
            [
                'tramite'  => 'Constancia de Residencia',
                'ciudadano'=> 1,
                'etapa'    => 2,
                'estado'   => 'en_proceso',
                'dias'     => -1,
                'historial'=> [
                    [1, 'Recepción y Registro', 'Solicitud registrada vía WhatsApp.'],
                    [2, 'Verificación en Padrón', 'Datos verificados en el padrón municipal.'],
                ],
            ],
            [
                'tramite'  => 'Solicitud de Alumbrado Público',
                'ciudadano'=> 2,
                'etapa'    => 3,
                'estado'   => 'en_proceso',
                'dias'     => -2,
                'historial'=> [
                    [1, 'Recepción de Solicitud', 'Solicitud registrada vía WhatsApp.'],
                    [2, 'Evaluación Técnica', 'Requerimientos técnicos evaluados correctamente.'],
                    [3, 'Inspección en Campo', 'Inspector asignado: Técnico Quispe. Visita programada para mañana.'],
                ],
            ],
            [
                'tramite'  => 'Denuncia por Basura Acumulada',
                'ciudadano'=> 3,
                'etapa'    => 4,
                'estado'   => 'en_proceso',
                'dias'     => -3,
                'historial'=> [
                    [1, 'Registro de Denuncia', 'Denuncia registrada vía WhatsApp.'],
                    [2, 'Asignación a Inspector', 'Inspector ambiental Flores asignado al caso.'],
                    [3, 'Verificación en Campo', 'Se constató acumulación de residuos en Av. Principal esquina Calle 5.'],
                    [4, 'Notificación al Infractor', 'Se notificó al propietario del terreno para limpieza en 48 horas.'],
                ],
            ],
            // Etapa 5 - Casi terminada
            [
                'tramite'  => 'Atención en SLIM - Unidad de la Mujer',
                'ciudadano'=> 4,
                'etapa'    => 5,
                'estado'   => 'en_proceso',
                'dias'     => -4,
                'historial'=> [
                    [1, 'Recepción y Registro', 'Caso registrado con confidencialidad vía WhatsApp.'],
                    [2, 'Entrevista Social', 'Entrevista realizada por la Lic. Mamani el 05/04/2026.'],
                    [3, 'Evaluación Psicológica', 'Evaluación psicológica completada. Estado: estable.'],
                    [4, 'Orientación y Patrocinio Legal', 'Se brindó orientación legal. Se inicia proceso de patrocinio.'],
                    [5, 'Seguimiento del Caso', 'Caso en seguimiento activo. Próxima cita: 15/04/2026.'],
                ],
            ],
            [
                'tramite'  => 'Constancia de Residencia',
                'ciudadano'=> 5,
                'etapa'    => 6,
                'estado'   => 'completado',
                'dias'     => -5,
                'historial'=> [
                    [1, 'Recepción y Registro', 'Solicitud registrada vía portal web.'],
                    [2, 'Verificación en Padrón', 'Padrón consultado. Residencia verificada desde 2018.'],
                    [3, 'Consulta de Historial', 'Historial de 8 años de residencia confirmado.'],
                    [4, 'Elaboración de Constancia', 'Constancia elaborada con datos completos.'],
                    [5, 'Firma y Sellado', 'Firmado por el Director de Gestión Documental.'],
                    [6, 'Listo para Retiro', 'La constancia está lista para retiro en Gestión Documental (PB).'],
                ],
            ],
            [
                'tramite'  => 'Denuncia de Construcción Ilegal',
                'ciudadano'=> 6,
                'etapa'    => 2,
                'estado'   => 'cancelado',
                'dias'     => -6,
                'obs'      => 'Ciudadano desistió de la denuncia al regularizar la construcción.',
                'historial'=> [
                    [1, 'Registro de Denuncia', 'Denuncia ingresada vía WhatsApp.'],
                    [2, 'Asignación Técnica', 'Se asignó técnico de supervisión.'],
                    [2, 'Cancelado', 'Ciudadano desistió de la denuncia al regularizar la construcción.'],
                ],
            ],
            [
                'tramite'  => 'Atención para Adulto Mayor',
                'ciudadano'=> 7,
                'etapa'    => 3,
                'estado'   => 'en_proceso',
                'dias'     => -2,
                'historial'=> [
                    [1, 'Recepción de Solicitud', 'Solicitud registrada vía WhatsApp por familiar.'],
                    [2, 'Evaluación de Necesidades', 'Trabajadora social realizó evaluación inicial.'],
                    [3, 'Visita Domiciliaria', 'Visita programada para el 12/04/2026 a las 10:00 AM.'],
                ],
            ],
        ];

        foreach ($solicitudes as $idx => $data) {
            $tramiteId = $tramites[$data['tramite']] ?? null;
            if (! $tramiteId) {
                continue;
            }

            $ciudadano = $ciudadanos[$data['ciudadano']];
            $createdAt = now()->addDays($data['dias']);

            $solicitudId = DB::table('tramite_solicitudes')->insertGetId([
                'tramite_id'       => $tramiteId,
                'phone'            => $ciudadano['phone'],
                'nombre_ciudadano' => $ciudadano['nombre'],
                'ci'               => $ciudadano['ci'],
                'etapa_actual'     => $data['etapa'],
                'estado'           => $data['estado'],
                'observaciones'    => $data['obs'] ?? null,
                'created_at'       => $createdAt,
                'updated_at'       => now(),
            ]);

            DB::table('tramite_solicitudes')
                ->where('id', $solicitudId)
                ->update([
                    'numero_seguimiento' => 'TRM-' . $createdAt->format('Ym') . '-' . str_pad((string) $solicitudId, 5, '0', STR_PAD_LEFT),
                ]);

            foreach ($data['historial'] as $offset => $h) {
                [$orden, $nombre, $obs] = $h;
                DB::table('tramite_solicitud_historial')->insert([
                    'solicitud_id' => $solicitudId,
                    'etapa_orden'  => $orden,
                    'etapa_nombre' => $nombre,
                    'observacion'  => $obs,
                    'created_at'   => $createdAt->copy()->addHours($offset),
                    'updated_at'   => $createdAt->copy()->addHours($offset),
                ]);
            }
        }

        $this->command->info('✅ ' . count($solicitudes) . ' solicitudes de prueba creadas.');
    }
}
