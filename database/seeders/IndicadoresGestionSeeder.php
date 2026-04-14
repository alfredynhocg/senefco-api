<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicadoresGestionSeeder extends Seeder
{
    public function run(): void
    {
        $indicadores = [
            ['categoria_id' => 1, 'nombre' => 'Ejecución Presupuestaria (%)',              'descripcion' => 'Porcentaje de ejecución del presupuesto municipal.',         'unidad_medida' => '%',          'frecuencia_actualizacion' => 'mensual',    'publico' => true, 'activo' => true, 'orden_dashboard' => 1],
            ['categoria_id' => 1, 'nombre' => 'Recaudación Tributaria (Bs.)',               'descripcion' => 'Monto total recaudado en impuestos y tasas municipales.',     'unidad_medida' => 'Bolivianos', 'frecuencia_actualizacion' => 'mensual',    'publico' => true, 'activo' => true, 'orden_dashboard' => 2],
            ['categoria_id' => 2, 'nombre' => 'Cobertura de Agua Potable (%)',              'descripcion' => 'Porcentaje de hogares con acceso a agua potable.',            'unidad_medida' => '%',          'frecuencia_actualizacion' => 'trimestral', 'publico' => true, 'activo' => true, 'orden_dashboard' => 3],
            ['categoria_id' => 2, 'nombre' => 'Kilómetros de Vías Mejoradas',              'descripcion' => 'Total de kilómetros de vías mejoradas en el año.',            'unidad_medida' => 'km',         'frecuencia_actualizacion' => 'trimestral', 'publico' => true, 'activo' => true, 'orden_dashboard' => 4],
            ['categoria_id' => 3, 'nombre' => 'Tasa de Asistencia Escolar (%)',            'descripcion' => 'Porcentaje de niños en edad escolar que asisten a clases.',   'unidad_medida' => '%',          'frecuencia_actualizacion' => 'anual',      'publico' => true, 'activo' => true, 'orden_dashboard' => 5],
            ['categoria_id' => 4, 'nombre' => 'Cobertura de Salud (%)',                    'descripcion' => 'Porcentaje de población con acceso a servicios de salud.',    'unidad_medida' => '%',          'frecuencia_actualizacion' => 'trimestral', 'publico' => true, 'activo' => true, 'orden_dashboard' => 6],
            ['categoria_id' => 4, 'nombre' => 'Vacunación Infantil (%)',                   'descripcion' => 'Porcentaje de niños menores de 5 años vacunados.',            'unidad_medida' => '%',          'frecuencia_actualizacion' => 'mensual',    'publico' => true, 'activo' => true, 'orden_dashboard' => 7],
            ['categoria_id' => 5, 'nombre' => 'Microempresas Registradas',                 'descripcion' => 'Número de microempresas registradas en el municipio.',        'unidad_medida' => 'Unidades',   'frecuencia_actualizacion' => 'mensual',    'publico' => true, 'activo' => true, 'orden_dashboard' => 8],
            ['categoria_id' => 6, 'nombre' => 'Áreas Verdes por Habitante (m²)',           'descripcion' => 'Metros cuadrados de área verde por habitante.',               'unidad_medida' => 'm²/hab',     'frecuencia_actualizacion' => 'anual',      'publico' => true, 'activo' => true, 'orden_dashboard' => 9],
            ['categoria_id' => 7, 'nombre' => 'Índice de Satisfacción Ciudadana (%)',      'descripcion' => 'Porcentaje de ciudadanos satisfechos con los servicios.',     'unidad_medida' => '%',          'frecuencia_actualizacion' => 'semestral',  'publico' => true, 'activo' => true, 'orden_dashboard' => 10],
            ['categoria_id' => 7, 'nombre' => 'Trámites Resueltos en Plazo (%)',           'descripcion' => 'Porcentaje de trámites resueltos dentro del plazo legal.',    'unidad_medida' => '%',          'frecuencia_actualizacion' => 'mensual',    'publico' => true, 'activo' => true, 'orden_dashboard' => 11],
            ['categoria_id' => 8, 'nombre' => 'Proyectos de Inversión Concluidos',         'descripcion' => 'Número de proyectos de inversión concluidos en el año.',      'unidad_medida' => 'Proyectos',  'frecuencia_actualizacion' => 'trimestral', 'publico' => true, 'activo' => true, 'orden_dashboard' => 12],
        ];

        foreach ($indicadores as $i) {
            DB::table('indicadores_gestion')->insert($i);
        }
    }
}
