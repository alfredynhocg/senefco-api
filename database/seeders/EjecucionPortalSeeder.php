<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EjecucionPortalSeeder extends Seeder
{
    public function run(): void
    {
        $secretarias = [
            'Secretaría Municipal',
            'Secretaría de Hacienda y Finanzas',
            'Secretaría de Obras Públicas e Infraestructura',
            'Secretaría de Desarrollo Humano y Social',
            'Secretaría de Medio Ambiente y Gestión de Riesgos',
            'Secretaría de Planificación y Desarrollo Económico',
            'Secretaría Jurídica y Legal',
            'Secretaría de Cultura, Turismo y Deportes',
        ];

        $fuentesFinanciamiento = [
            'Recursos Propios',
            'IDH (Impuesto Directo a los Hidrocarburos)',
            'HIPC II',
            'Coparticipación Tributaria',
            'Recursos Externos — BID',
            'Fondo Nacional de Inversión Productiva y Social',
        ];

        $registros = [];

        $presupuestos2026 = [
            'Secretaría Municipal'                               => ['inicial' => 8_500_000, 'vigente' => 8_500_000],
            'Secretaría de Hacienda y Finanzas'                 => ['inicial' => 12_000_000, 'vigente' => 12_000_000],
            'Secretaría de Obras Públicas e Infraestructura'    => ['inicial' => 15_000_000, 'vigente' => 16_200_000],
            'Secretaría de Desarrollo Humano y Social'          => ['inicial' => 6_000_000,  'vigente' => 6_000_000],
            'Secretaría de Medio Ambiente y Gestión de Riesgos' => ['inicial' => 7_500_000,  'vigente' => 7_500_000],
            'Secretaría de Planificación y Desarrollo Económico' => ['inicial' => 3_500_000, 'vigente' => 3_500_000],
            'Secretaría Jurídica y Legal'                       => ['inicial' => 9_000_000,  'vigente' => 9_000_000],
            'Secretaría de Cultura, Turismo y Deportes'         => ['inicial' => 4_000_000,  'vigente' => 4_000_000],
        ];

        $tasasAcumuladas = [
            1 => [  // enero: arranque lento
                'Secretaría Municipal'                               => 7.2,
                'Secretaría de Hacienda y Finanzas'                 => 6.8,
                'Secretaría de Obras Públicas e Infraestructura'    => 4.1,
                'Secretaría de Desarrollo Humano y Social'          => 8.5,
                'Secretaría de Medio Ambiente y Gestión de Riesgos' => 5.9,
                'Secretaría de Planificación y Desarrollo Económico' => 6.3,
                'Secretaría Jurídica y Legal'                       => 7.8,
                'Secretaría de Cultura, Turismo y Deportes'         => 5.5,
            ],
            2 => [  // febrero: aceleración
                'Secretaría Municipal'                               => 15.1,
                'Secretaría de Hacienda y Finanzas'                 => 14.3,
                'Secretaría de Obras Públicas e Infraestructura'    => 10.2,
                'Secretaría de Desarrollo Humano y Social'          => 17.0,
                'Secretaría de Medio Ambiente y Gestión de Riesgos' => 12.4,
                'Secretaría de Planificación y Desarrollo Económico' => 13.1,
                'Secretaría Jurídica y Legal'                       => 16.2,
                'Secretaría de Cultura, Turismo y Deportes'         => 11.8,
            ],
            3 => [  // marzo: consolidación Q1
                'Secretaría Municipal'                               => 23.4,
                'Secretaría de Hacienda y Finanzas'                 => 22.7,
                'Secretaría de Obras Públicas e Infraestructura'    => 17.5,
                'Secretaría de Desarrollo Humano y Social'          => 25.8,
                'Secretaría de Medio Ambiente y Gestión de Riesgos' => 19.6,
                'Secretaría de Planificación y Desarrollo Económico' => 20.9,
                'Secretaría Jurídica y Legal'                       => 24.5,
                'Secretaría de Cultura, Turismo y Deportes'         => 18.3,
            ],
        ];

        $mesesNombres = [1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo'];
        $programas = [
            'Secretaría Municipal'                               => 'Gestión Institucional y Administración',
            'Secretaría de Hacienda y Finanzas'                 => 'Administración Financiera Municipal',
            'Secretaría de Obras Públicas e Infraestructura'    => 'Infraestructura Vial y Obras Civiles',
            'Secretaría de Desarrollo Humano y Social'          => 'Programas Sociales y Bienestar Ciudadano',
            'Secretaría de Medio Ambiente y Gestión de Riesgos' => 'Gestión Ambiental y Reducción de Riesgos',
            'Secretaría de Planificación y Desarrollo Económico' => 'Planificación Estratégica y Fomento Económico',
            'Secretaría Jurídica y Legal'                       => 'Asesoría Jurídica y Representación Legal',
            'Secretaría de Cultura, Turismo y Deportes'         => 'Promoción Cultural, Turística y Deportiva',
        ];

        $fuentesPorSecretaria = [
            'Secretaría Municipal'                               => 'Recursos Propios',
            'Secretaría de Hacienda y Finanzas'                 => 'Recursos Propios',
            'Secretaría de Obras Públicas e Infraestructura'    => 'IDH (Impuesto Directo a los Hidrocarburos)',
            'Secretaría de Desarrollo Humano y Social'          => 'Coparticipación Tributaria',
            'Secretaría de Medio Ambiente y Gestión de Riesgos' => 'HIPC II',
            'Secretaría de Planificación y Desarrollo Económico' => 'IDH (Impuesto Directo a los Hidrocarburos)',
            'Secretaría Jurídica y Legal'                       => 'Recursos Propios',
            'Secretaría de Cultura, Turismo y Deportes'         => 'Coparticipación Tributaria',
        ];

        foreach ($presupuestos2026 as $secretaria => $montos) {
            foreach ([1, 2, 3] as $mes) {
                $tasa = $tasasAcumuladas[$mes][$secretaria] / 100;
                $ejecutado = round($montos['vigente'] * $tasa, 2);

                $registros[] = [
                    'anio'                  => 2026,
                    'periodo'               => 'mensual',
                    'mes'                   => $mes,
                    'trimestre'             => null,
                    'semestre'              => null,
                    'unidad_ejecutora'      => $secretaria,
                    'programa'              => $programas[$secretaria],
                    'fuente_financiamiento' => $fuentesPorSecretaria[$secretaria],
                    'presupuesto_inicial'   => $montos['inicial'],
                    'presupuesto_vigente'   => $montos['vigente'],
                    'ejecutado'             => $ejecutado,
                    'descripcion'           => "Reporte mensual de ejecución presupuestaria — {$mesesNombres[$mes]} 2026. Incluye gastos devengados y pagados en el período.",
                    'archivo_url'           => null,
                    'archivo_nombre'        => null,
                    'publicado'             => true,
                    'created_at'            => "2026-0{$mes}-" . ($mes === 2 ? '28' : '31') . ' 12:00:00',
                    'updated_at'            => "2026-0{$mes}-" . ($mes === 2 ? '28' : '31') . ' 12:00:00',
                ];
            }

            $tasaQ1 = $tasasAcumuladas[3][$secretaria] / 100;
            $ejecutadoQ1 = round($montos['vigente'] * $tasaQ1, 2);
            $registros[] = [
                'anio'                  => 2026,
                'periodo'               => 'trimestral',
                'mes'                   => null,
                'trimestre'             => 1,
                'semestre'              => null,
                'unidad_ejecutora'      => $secretaria,
                'programa'              => $programas[$secretaria],
                'fuente_financiamiento' => $fuentesPorSecretaria[$secretaria],
                'presupuesto_inicial'   => $montos['inicial'],
                'presupuesto_vigente'   => $montos['vigente'],
                'ejecutado'             => $ejecutadoQ1,
                'descripcion'           => "Informe de ejecución presupuestaria — Primer Trimestre (Ene–Mar) 2026. Consolidado del período enero a marzo.",
                'archivo_url'           => null,
                'archivo_nombre'        => null,
                'publicado'             => true,
                'created_at'            => '2026-04-05 10:00:00',
                'updated_at'            => '2026-04-05 10:00:00',
            ];
        }

        $presupuestos2025 = [
            'Secretaría de Hacienda y Finanzas'              => ['inicial' => 11_000_000, 'vigente' => 11_000_000],
            'Secretaría de Obras Públicas e Infraestructura' => ['inicial' => 14_000_000, 'vigente' => 14_800_000],
        ];

        $tasasTrimestrales2025 = [
            'Secretaría de Hacienda y Finanzas'              => [1 => 22.1, 2 => 47.3, 3 => 73.5, 4 => 97.8],
            'Secretaría de Obras Públicas e Infraestructura' => [1 => 14.2, 2 => 38.6, 3 => 68.4, 4 => 95.3],
        ];

        foreach ($presupuestos2025 as $secretaria => $montos) {
            foreach ([1, 2, 3, 4] as $trimestre) {
                $tasa = $tasasTrimestrales2025[$secretaria][$trimestre] / 100;
                $ejecutado = round($montos['vigente'] * $tasa, 2);

                $registros[] = [
                    'anio'                  => 2025,
                    'periodo'               => 'trimestral',
                    'mes'                   => null,
                    'trimestre'             => $trimestre,
                    'semestre'              => null,
                    'unidad_ejecutora'      => $secretaria,
                    'programa'              => $programas[$secretaria],
                    'fuente_financiamiento' => $fuentesPorSecretaria[$secretaria],
                    'presupuesto_inicial'   => $montos['inicial'],
                    'presupuesto_vigente'   => $montos['vigente'],
                    'ejecutado'             => $ejecutado,
                    'descripcion'           => "Informe de ejecución presupuestaria — Trimestre {$trimestre} 2025.",
                    'archivo_url'           => null,
                    'archivo_nombre'        => "ejecucion_T{$trimestre}_2025.pdf",
                    'publicado'             => true,
                    'created_at'            => "2025-" . str_pad($trimestre * 3, 2, '0', STR_PAD_LEFT) . "-30 12:00:00",
                    'updated_at'            => "2025-" . str_pad($trimestre * 3, 2, '0', STR_PAD_LEFT) . "-30 12:00:00",
                ];
            }

            foreach ([1, 2] as $semestre) {
                $tasaS = $semestre === 1
                    ? $tasasTrimestrales2025[$secretaria][2]
                    : $tasasTrimestrales2025[$secretaria][4];
                $ejecutadoS = round($montos['vigente'] * ($tasaS / 100), 2);

                $registros[] = [
                    'anio'                  => 2025,
                    'periodo'               => 'semestral',
                    'mes'                   => null,
                    'trimestre'             => null,
                    'semestre'              => $semestre,
                    'unidad_ejecutora'      => $secretaria,
                    'programa'              => $programas[$secretaria],
                    'fuente_financiamiento' => $fuentesPorSecretaria[$secretaria],
                    'presupuesto_inicial'   => $montos['inicial'],
                    'presupuesto_vigente'   => $montos['vigente'],
                    'ejecutado'             => $ejecutadoS,
                    'descripcion'           => "Informe de ejecución presupuestaria — " . ($semestre === 1 ? 'Primer' : 'Segundo') . " Semestre 2025.",
                    'archivo_url'           => null,
                    'archivo_nombre'        => "ejecucion_S{$semestre}_2025.pdf",
                    'publicado'             => true,
                    'created_at'            => ($semestre === 1 ? '2025-07-15' : '2025-12-31') . ' 12:00:00',
                    'updated_at'            => ($semestre === 1 ? '2025-07-15' : '2025-12-31') . ' 12:00:00',
                ];
            }

            $tasaAnual = $tasasTrimestrales2025[$secretaria][4] / 100;
            $ejecutadoAnual = round($montos['vigente'] * $tasaAnual, 2);
            $registros[] = [
                'anio'                  => 2025,
                'periodo'               => 'anual',
                'mes'                   => null,
                'trimestre'             => null,
                'semestre'              => null,
                'unidad_ejecutora'      => $secretaria,
                'programa'              => $programas[$secretaria],
                'fuente_financiamiento' => $fuentesPorSecretaria[$secretaria],
                'presupuesto_inicial'   => $montos['inicial'],
                'presupuesto_vigente'   => $montos['vigente'],
                'ejecutado'             => $ejecutadoAnual,
                'descripcion'           => "Informe de cierre y ejecución presupuestaria anual — Gestión 2025.",
                'archivo_url'           => null,
                'archivo_nombre'        => 'ejecucion_anual_2025.pdf',
                'publicado'             => true,
                'created_at'            => '2026-01-31 12:00:00',
                'updated_at'            => '2026-01-31 12:00:00',
            ];
        }

        DB::table('ejecucion_presupuestaria_portal')->insert($registros);

        $this->command->info('✅ ' . count($registros) . ' registros de ejecución presupuestaria (portal) creados.');
    }
}
