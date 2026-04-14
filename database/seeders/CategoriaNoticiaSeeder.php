<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaNoticiaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias_noticia')->insert([
            ['nombre' => 'Obras e Infraestructura',  'slug' => 'obras-infraestructura',  'descripcion' => 'Proyectos y avances de obras públicas',         'color_hex' => '#C62828', 'activa' => true],
            ['nombre' => 'Salud',                    'slug' => 'salud',                  'descripcion' => 'Noticias del sector salud municipal',           'color_hex' => '#AD1457', 'activa' => true],
            ['nombre' => 'Educación',               'slug' => 'educacion',              'descripcion' => 'Noticias del sector educativo',                 'color_hex' => '#1565C0', 'activa' => true],
            ['nombre' => 'Cultura y Deporte',       'slug' => 'cultura-deporte',        'descripcion' => 'Eventos y actividades culturales y deportivas', 'color_hex' => '#E65100', 'activa' => true],
            ['nombre' => 'Seguridad Ciudadana',     'slug' => 'seguridad-ciudadana',    'descripcion' => 'Información de seguridad pública',              'color_hex' => '#6A1B9A', 'activa' => true],
            ['nombre' => 'Medio Ambiente',           'slug' => 'medio-ambiente',         'descripcion' => 'Noticias sobre medioambiente y sostenibilidad', 'color_hex' => '#2E7D32', 'activa' => true],
            ['nombre' => 'Social',                   'slug' => 'social',                 'descripcion' => 'Programas y eventos sociales',                  'color_hex' => '#00838F', 'activa' => true],
            ['nombre' => 'Institucional',            'slug' => 'institucional',          'descripcion' => 'Noticias internas de la alcaldía',              'color_hex' => '#F9A825', 'activa' => true],
            ['nombre' => 'Eventos',                  'slug' => 'eventos',                'descripcion' => 'Agenda y cobertura de eventos oficiales',       'color_hex' => '#558B2F', 'activa' => true],
        ]);
    }
}
