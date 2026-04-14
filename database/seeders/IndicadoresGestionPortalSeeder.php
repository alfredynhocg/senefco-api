<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class IndicadoresGestionPortalSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('indicadores_gestion_portal')->count() > 0) {
            return;
        }

        $categoryMap = [
            1 => 'economico',
            2 => 'infraestructura',
            3 => 'social',
            4 => 'social',
            5 => 'medioambiente',
            6 => 'salud',
            7 => 'educacion',
            8 => 'seguridad',
        ];

        $indicadores = DB::table('indicadores_gestion')->orderBy('id')->get();
        $now = Date::now()->toDateTimeString();

        foreach ($indicadores as $indicador) {
            DB::table('indicadores_gestion_portal')->insert([
                'nombre' => $indicador->nombre,
                'descripcion' => $indicador->descripcion,
                'categoria' => $categoryMap[$indicador->categoria_id] ?? 'otro',
                'unidad' => $indicador->unidad_medida,
                'meta' => null,
                'valor_actual' => null,
                'periodo' => $indicador->frecuencia_actualizacion,
                'fecha_medicion' => null,
                'estado' => 'sin_dato',
                'responsable' => null,
                'publicado' => (bool) $indicador->publico,
                'activo' => (bool) $indicador->activo,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
