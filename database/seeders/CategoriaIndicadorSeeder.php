<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaIndicadorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias_indicador')->insert([
            ['nombre' => 'Finanzas Municipales',    'icono' => 'bi-currency-dollar',   'color_hex' => '#1565C0', 'activa' => true],
            ['nombre' => 'Obras e Infraestructura', 'icono' => 'bi-building',           'color_hex' => '#C62828', 'activa' => true],
            ['nombre' => 'Servicios Públicos',      'icono' => 'bi-gear',               'color_hex' => '#2E7D32', 'activa' => true],
            ['nombre' => 'Desarrollo Social',       'icono' => 'bi-people',             'color_hex' => '#6A1B9A', 'activa' => true],
            ['nombre' => 'Medio Ambiente',          'icono' => 'bi-tree',               'color_hex' => '#558B2F', 'activa' => true],
            ['nombre' => 'Salud',                   'icono' => 'bi-heart-pulse',        'color_hex' => '#AD1457', 'activa' => true],
            ['nombre' => 'Educación',              'icono' => 'bi-book',               'color_hex' => '#E65100', 'activa' => true],
            ['nombre' => 'Seguridad',               'icono' => 'bi-shield-check',       'color_hex' => '#00838F', 'activa' => true],
        ]);
    }
}
