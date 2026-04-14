<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposTramiteSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tipos_tramite')->insert([
            ['nombre' => 'Impuestos y Tasas',        'slug' => 'impuestos-tasas',       'color_hex' => '#1565C0', 'activo' => true, 'orden' => 1, 'created_at' => $now],
            ['nombre' => 'Catastro Urbano',          'slug' => 'catastro-urbano',       'color_hex' => '#2E7D32', 'activo' => true, 'orden' => 2, 'created_at' => $now],
            ['nombre' => 'Registro de Negocios',     'slug' => 'registro-negocios',     'color_hex' => '#E65100', 'activo' => true, 'orden' => 3, 'created_at' => $now],
            ['nombre' => 'Servicios Sociales',       'slug' => 'servicios-sociales',    'color_hex' => '#6A1B9A', 'activo' => true, 'orden' => 4, 'created_at' => $now],
            ['nombre' => 'Medio Ambiente',           'slug' => 'medio-ambiente',        'color_hex' => '#558B2F', 'activo' => true, 'orden' => 5, 'created_at' => $now],
            ['nombre' => 'Obras Públicas',           'slug' => 'obras-publicas',        'color_hex' => '#C62828', 'activo' => true, 'orden' => 6, 'created_at' => $now],
            ['nombre' => 'Tránsito y Vialidad',     'slug' => 'transito-vialidad',     'color_hex' => '#00838F', 'activo' => true, 'orden' => 7, 'created_at' => $now],
            ['nombre' => 'Salud',                    'slug' => 'salud',                 'color_hex' => '#AD1457', 'activo' => true, 'orden' => 8, 'created_at' => $now],
            ['nombre' => 'Educación y Cultura',     'slug' => 'educacion-cultura',     'color_hex' => '#F9A825', 'activo' => true, 'orden' => 9, 'created_at' => $now],
        ]);
    }
}
