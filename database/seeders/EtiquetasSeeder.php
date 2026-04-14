<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtiquetasSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('etiquetas')->count() > 0) {
            return;
        }

        $etiquetas = [
            ['nombre' => 'Municipal',           'slug' => 'municipal'],
            ['nombre' => 'Seguridad',           'slug' => 'seguridad'],
            ['nombre' => 'Salud',               'slug' => 'salud'],
            ['nombre' => 'Educación',           'slug' => 'educacion'],
            ['nombre' => 'Medio Ambiente',      'slug' => 'medio-ambiente'],
            ['nombre' => 'Eventos',             'slug' => 'eventos'],
            ['nombre' => 'Transparencia',       'slug' => 'transparencia'],
            ['nombre' => 'Comunicados',         'slug' => 'comunicados'],
            ['nombre' => 'Obras',               'slug' => 'obras'],
            ['nombre' => 'Cultura',             'slug' => 'cultura'],
        ];

        DB::table('etiquetas')->insert($etiquetas);
    }
}
