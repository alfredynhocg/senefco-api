<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposEventoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos_evento')->insert([
            ['nombre' => 'Audiencia Pública',         'color_hex' => '#1565C0', 'activo' => true],
            ['nombre' => 'Acto Cívico',               'color_hex' => '#2E7D32', 'activo' => true],
            ['nombre' => 'Reunión del Concejo',       'color_hex' => '#6A1B9A', 'activo' => true],
            ['nombre' => 'Evento Cultural',           'color_hex' => '#E65100', 'activo' => true],
            ['nombre' => 'Evento Deportivo',          'color_hex' => '#00838F', 'activo' => true],
            ['nombre' => 'Capacitación',              'color_hex' => '#558B2F', 'activo' => true],
            ['nombre' => 'Feria Municipal',           'color_hex' => '#F9A825', 'activo' => true],
            ['nombre' => 'Inauguración de Obras',     'color_hex' => '#C62828', 'activo' => true],
        ]);
    }
}
