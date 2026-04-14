<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanesGobiernoSeeder extends Seeder
{
    public function run(): void
    {
        $planes = [
            ['titulo' => 'Plan Municipal de Desarrollo 2021-2025', 'gestion_inicio' => 2021, 'gestion_fin' => 2025, 'descripcion' => 'Plan de desarrollo municipal quinquenal para la gestión 2021-2025, alineado con el Plan de Desarrollo Económico y Social del Estado.', 'documento_pdf_url' => 'https://senefco.gob.bo/planes/pmdi-2021-2025.pdf', 'publicado_por' => 1, 'vigente' => false],
            ['titulo' => 'Plan Municipal de Desarrollo 2026-2030', 'gestion_inicio' => 2026, 'gestion_fin' => 2030, 'descripcion' => 'Plan de desarrollo municipal quinquenal para la gestión 2026-2030, enfocado en desarrollo productivo, infraestructura y servicios básicos.', 'documento_pdf_url' => 'https://senefco.gob.bo/planes/pmdi-2026-2030.pdf', 'publicado_por' => 1, 'vigente' => true],
        ];

        foreach ($planes as $plan) {
            DB::table('planes_gobierno')->insert($plan);
        }
    }
}
