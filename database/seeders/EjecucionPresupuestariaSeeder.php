<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EjecucionPresupuestariaSeeder extends Seeder
{
    public function run(): void
    {
        $partidas = [

            // ─ Presupuesto 1: Secretaría Municipal (Bs 8.500.000) ─────────────
            ['presupuesto_id' => 1, 'codigo_partida' => '10000', 'descripcion' => 'Servicios Personales', 'monto_asignado' => 3_500_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 1, 'codigo_partida' => '20000', 'descripcion' => 'Servicios No Personales', 'monto_asignado' => 1_200_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 1, 'codigo_partida' => '30000', 'descripcion' => 'Materiales y Suministros', 'monto_asignado' => 800_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 1, 'codigo_partida' => '40000', 'descripcion' => 'Activos Reales', 'monto_asignado' => 1_500_000, 'categoria' => 'capital'],
            ['presupuesto_id' => 1, 'codigo_partida' => '50000', 'descripcion' => 'Transferencias Corrientes', 'monto_asignado' => 1_500_000, 'categoria' => 'transferencias'],

            // ─ Presupuesto 2: Secretaría de Hacienda y Finanzas (Bs 12.000.000)
            ['presupuesto_id' => 2, 'codigo_partida' => '10000', 'descripcion' => 'Servicios Personales', 'monto_asignado' => 4_500_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 2, 'codigo_partida' => '20000', 'descripcion' => 'Servicios No Personales', 'monto_asignado' => 2_000_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 2, 'codigo_partida' => '30000', 'descripcion' => 'Materiales y Suministros', 'monto_asignado' => 1_000_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 2, 'codigo_partida' => '40000', 'descripcion' => 'Activos Reales — Equipos Informáticos', 'monto_asignado' => 2_500_000, 'categoria' => 'capital'],
            ['presupuesto_id' => 2, 'codigo_partida' => '50000', 'descripcion' => 'Transferencias y Subsidios', 'monto_asignado' => 2_000_000, 'categoria' => 'transferencias'],

            // ─ Presupuesto 3: Obras Públicas (Bs 15.000.000 modificado) ───────
            ['presupuesto_id' => 3, 'codigo_partida' => '10000', 'descripcion' => 'Servicios Personales', 'monto_asignado' => 2_500_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 3, 'codigo_partida' => '20000', 'descripcion' => 'Servicios No Personales — Consultorías', 'monto_asignado' => 1_500_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 3, 'codigo_partida' => '30000', 'descripcion' => 'Materiales de Construcción', 'monto_asignado' => 3_000_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 3, 'codigo_partida' => '40100', 'descripcion' => 'Infraestructura Vial — Pavimentación', 'monto_asignado' => 5_000_000, 'categoria' => 'capital'],
            ['presupuesto_id' => 3, 'codigo_partida' => '40200', 'descripcion' => 'Infraestructura Edilicia — Obras Civiles', 'monto_asignado' => 2_000_000, 'categoria' => 'capital'],
            ['presupuesto_id' => 3, 'codigo_partida' => '50000', 'descripcion' => 'Transferencias a Juntas Vecinales', 'monto_asignado' => 1_000_000, 'categoria' => 'transferencias'],

            // ─ Presupuesto 4: Desarrollo Humano y Social (Bs 6.000.000) ───────
            ['presupuesto_id' => 4, 'codigo_partida' => '10000', 'descripcion' => 'Servicios Personales', 'monto_asignado' => 2_200_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 4, 'codigo_partida' => '20000', 'descripcion' => 'Servicios No Personales', 'monto_asignado' => 800_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 4, 'codigo_partida' => '30000', 'descripcion' => 'Materiales y Suministros Sociales', 'monto_asignado' => 600_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 4, 'codigo_partida' => '50100', 'descripcion' => 'Transferencias — Bono Municipal Adulto Mayor', 'monto_asignado' => 1_500_000, 'categoria' => 'transferencias'],
            ['presupuesto_id' => 4, 'codigo_partida' => '50200', 'descripcion' => 'Transferencias — Programa Mujer Emprendedora', 'monto_asignado' => 900_000, 'categoria' => 'transferencias'],

            // ─ Presupuesto 5: Medio Ambiente y Gestión de Riesgos (Bs 7.500.000)
            ['presupuesto_id' => 5, 'codigo_partida' => '10000', 'descripcion' => 'Servicios Personales', 'monto_asignado' => 2_000_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 5, 'codigo_partida' => '20000', 'descripcion' => 'Servicios No Personales — Gestión Ambiental', 'monto_asignado' => 1_200_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 5, 'codigo_partida' => '30000', 'descripcion' => 'Materiales y Equipos Ambientales', 'monto_asignado' => 800_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 5, 'codigo_partida' => '40000', 'descripcion' => 'Activos Reales — Vehículos y Maquinaria', 'monto_asignado' => 2_000_000, 'categoria' => 'capital'],
            ['presupuesto_id' => 5, 'codigo_partida' => '50000', 'descripcion' => 'Transferencias — Plan de Contingencias', 'monto_asignado' => 1_500_000, 'categoria' => 'transferencias'],

            // ─ Presupuesto 6: Planificación y Desarrollo Económico (Bs 3.500.000)
            ['presupuesto_id' => 6, 'codigo_partida' => '10000', 'descripcion' => 'Servicios Personales', 'monto_asignado' => 1_500_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 6, 'codigo_partida' => '20000', 'descripcion' => 'Servicios No Personales — Consultorías POA', 'monto_asignado' => 700_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 6, 'codigo_partida' => '30000', 'descripcion' => 'Materiales y Publicaciones', 'monto_asignado' => 300_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 6, 'codigo_partida' => '50000', 'descripcion' => 'Transferencias — Fomento Productivo', 'monto_asignado' => 1_000_000, 'categoria' => 'transferencias'],

            // ─ Presupuesto 7: Secretaría Jurídica y Legal (Bs 9.000.000) ──────
            ['presupuesto_id' => 7, 'codigo_partida' => '10000', 'descripcion' => 'Servicios Personales', 'monto_asignado' => 3_800_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 7, 'codigo_partida' => '20000', 'descripcion' => 'Servicios Legales y Notariales', 'monto_asignado' => 2_500_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 7, 'codigo_partida' => '30000', 'descripcion' => 'Materiales y Suministros de Oficina', 'monto_asignado' => 500_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 7, 'codigo_partida' => '40000', 'descripcion' => 'Activos Reales — Mobiliario', 'monto_asignado' => 700_000, 'categoria' => 'capital'],
            ['presupuesto_id' => 7, 'codigo_partida' => '70000', 'descripcion' => 'Servicio de Deuda Pública', 'monto_asignado' => 1_500_000, 'categoria' => 'deuda'],

            // ─ Presupuesto 8: Cultura, Turismo y Deportes (Bs 4.000.000) ──────
            ['presupuesto_id' => 8, 'codigo_partida' => '10000', 'descripcion' => 'Servicios Personales', 'monto_asignado' => 1_200_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 8, 'codigo_partida' => '20000', 'descripcion' => 'Servicios No Personales — Eventos y Logística', 'monto_asignado' => 800_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 8, 'codigo_partida' => '30000', 'descripcion' => 'Materiales Culturales y Deportivos', 'monto_asignado' => 500_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 8, 'codigo_partida' => '40000', 'descripcion' => 'Activos Reales — Infraestructura Deportiva', 'monto_asignado' => 1_000_000, 'categoria' => 'capital'],
            ['presupuesto_id' => 8, 'codigo_partida' => '50000', 'descripcion' => 'Transferencias — Clubes y Asociaciones', 'monto_asignado' => 500_000, 'categoria' => 'transferencias'],

            // ─ Presupuesto 9: Hacienda 2025 (cerrado, Bs 11.000.000) ──────────
            ['presupuesto_id' => 9, 'codigo_partida' => '10000', 'descripcion' => 'Servicios Personales', 'monto_asignado' => 4_200_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 9, 'codigo_partida' => '20000', 'descripcion' => 'Servicios No Personales', 'monto_asignado' => 1_800_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 9, 'codigo_partida' => '30000', 'descripcion' => 'Materiales y Suministros', 'monto_asignado' => 900_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 9, 'codigo_partida' => '40000', 'descripcion' => 'Activos Reales', 'monto_asignado' => 2_100_000, 'categoria' => 'capital'],
            ['presupuesto_id' => 9, 'codigo_partida' => '50000', 'descripcion' => 'Transferencias', 'monto_asignado' => 2_000_000, 'categoria' => 'transferencias'],

            // ─ Presupuesto 10: Obras Públicas 2025 (cerrado, Bs 14.000.000) ───
            ['presupuesto_id' => 10, 'codigo_partida' => '10000', 'descripcion' => 'Servicios Personales', 'monto_asignado' => 2_300_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 10, 'codigo_partida' => '20000', 'descripcion' => 'Servicios No Personales — Consultorías', 'monto_asignado' => 1_400_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 10, 'codigo_partida' => '30000', 'descripcion' => 'Materiales de Construcción', 'monto_asignado' => 2_800_000, 'categoria' => 'corriente'],
            ['presupuesto_id' => 10, 'codigo_partida' => '40100', 'descripcion' => 'Infraestructura Vial', 'monto_asignado' => 5_500_000, 'categoria' => 'capital'],
            ['presupuesto_id' => 10, 'codigo_partida' => '40200', 'descripcion' => 'Obras Civiles Municipales', 'monto_asignado' => 2_000_000, 'categoria' => 'capital'],
        ];

        DB::table('partidas_presupuestarias')->insert($partidas);
        $this->command->info('✅ ' . count($partidas) . ' partidas presupuestarias creadas.');

        // Obtener IDs insertados por presupuesto_id
        $porPresupuesto = DB::table('partidas_presupuestarias')
            ->get()
            ->groupBy('presupuesto_id');

        $ejecuciones = [];

        $config2026 = [
            // [presupuesto_id, meses ejecutados, descripción patrón]
            1 => ['meses' => [1, 2, 3], 'factor' => 0.95],
            2 => ['meses' => [1, 2, 3], 'factor' => 0.88],
            3 => ['meses' => [1, 2, 3], 'factor' => 0.72],
            4 => ['meses' => [1, 2, 3], 'factor' => 0.91],
            5 => ['meses' => [1, 2, 3], 'factor' => 0.83],
            6 => ['meses' => [1, 2, 3], 'factor' => 0.78],
            7 => ['meses' => [1, 2, 3], 'factor' => 0.94],
            8 => ['meses' => [1, 2, 3], 'factor' => 0.80],
        ];

        $descripcionesMes = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
        ];

        $gastosDescripcion = [
            '10000' => 'Pago de planilla de sueldos y salarios del personal de planta',
            '20000' => 'Contratación de servicios: consultorías, utilities, mantenimiento',
            '20000_obras' => 'Consultorías técnicas de ingeniería y supervisión de obra',
            '30000' => 'Adquisición de materiales, útiles de oficina y consumibles',
            '30000_obras' => 'Compra de materiales de construcción: cemento, hierro, agregados',
            '40000' => 'Adquisición de activos: equipos, maquinaria y mobiliario',
            '40100' => 'Pago certificado de avance de obra — pavimentación y encarpetado',
            '40200' => 'Pago certificado de avance — obras civiles municipales',
            '50000' => 'Transferencias corrientes según programa aprobado',
            '50100' => 'Pago Bono Municipal Adulto Mayor — beneficiarios registrados',
            '50200' => 'Desembolso Programa Mujer Emprendedora — microcréditos',
            '70000' => 'Servicio de amortización e intereses deuda pública municipal',
        ];

        foreach ($config2026 as $presId => $cfg) {
            if (! isset($porPresupuesto[$presId])) {
                continue;
            }

            foreach ($porPresupuesto[$presId] as $partida) {
                $montoMensualBase = $partida->monto_asignado / 12;

                foreach ($cfg['meses'] as $mes) {
                    $factor = match (true) {
                        $partida->codigo_partida === '10000'             => 1.00,  // planilla fija
                        $partida->codigo_partida === '70000'             => 1.00,  // deuda fija
                        str_starts_with($partida->codigo_partida, '40') => match ($mes) {
                            1 => 0.30,  // lento arranque
                            2 => 0.55,
                            3 => 0.90,
                            default => 0.70,
                        },
                        str_starts_with($partida->codigo_partida, '50') => 0.85,
                        str_starts_with($partida->codigo_partida, '30') => match ($mes) {
                            1 => 0.60,
                            2 => 0.80,
                            3 => 0.95,
                            default => 0.80,
                        },
                        default => $cfg['factor'],
                    };

                    $devengado = round($montoMensualBase * $factor, 2);
                    $pagado    = round($devengado * (($mes === 3) ? 0.75 : 0.95), 2);

                    $descripcion = $gastosDescripcion[$partida->codigo_partida]
                        ?? "Ejecución presupuestaria {$descripcionesMes[$mes]} 2026";

                    $ejecuciones[] = [
                        'partida_id'        => $partida->id,
                        'proyecto_id'       => null,
                        'monto_devengado'   => $devengado,
                        'monto_pagado'      => $pagado,
                        'mes'               => $mes,
                        'gestion'           => 2026,
                        'descripcion_gasto' => "{$descripcion} — {$descripcionesMes[$mes]} 2026",
                        'fecha_registro'    => "2026-0{$mes}-" . ($mes === 1 ? '31' : ($mes === 2 ? '28' : '31')),
                        'registrado_por'    => null,
                    ];
                }
            }
        }

        $descripcionesMes2025 = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
        ];

        $diasPorMes = [
            1 => 31, 2 => 28, 3 => 31, 4 => 30, 5 => 31, 6 => 30,
            7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31,
        ];

        foreach ([9, 10] as $presId) {
            if (! isset($porPresupuesto[$presId])) {
                continue;
            }

            foreach ($porPresupuesto[$presId] as $partida) {
                $montoMensualBase = $partida->monto_asignado / 12;

                for ($mes = 1; $mes <= 12; $mes++) {
                    $factor = match (true) {
                        $partida->codigo_partida === '10000' => 1.00,
                        str_starts_with($partida->codigo_partida, '40') => match (true) {
                            $mes <= 2  => 0.25,
                            $mes <= 4  => 0.60,
                            $mes <= 8  => 0.95,
                            $mes <= 10 => 1.10,
                            default    => 0.90,
                        },
                        str_starts_with($partida->codigo_partida, '50') => 0.90,
                        default => match (true) {
                            $mes <= 2  => 0.70,
                            $mes <= 6  => 0.90,
                            $mes <= 10 => 1.00,
                            default    => 0.95,
                        },
                    };

                    $devengado = round($montoMensualBase * $factor, 2);
                    $pagado    = round($devengado, 2);

                    $descripcion = $gastosDescripcion[$partida->codigo_partida]
                        ?? "Ejecución presupuestaria {$descripcionesMes2025[$mes]} 2025";

                    $dia = str_pad($diasPorMes[$mes], 2, '0', STR_PAD_LEFT);
                    $mesStr = str_pad($mes, 2, '0', STR_PAD_LEFT);

                    $ejecuciones[] = [
                        'partida_id'        => $partida->id,
                        'proyecto_id'       => null,
                        'monto_devengado'   => $devengado,
                        'monto_pagado'      => $pagado,
                        'mes'               => $mes,
                        'gestion'           => 2025,
                        'descripcion_gasto' => "{$descripcion} — {$descripcionesMes2025[$mes]} 2025",
                        'fecha_registro'    => "2025-{$mesStr}-{$dia}",
                        'registrado_por'    => null,
                    ];
                }
            }
        }

        foreach (array_chunk($ejecuciones, 50) as $chunk) {
            DB::table('ejecucion_presupuestaria')->insert($chunk);
        }

        $this->command->info('✅ ' . count($ejecuciones) . ' registros de ejecución presupuestaria creados.');
    }
}
