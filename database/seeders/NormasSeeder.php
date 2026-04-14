<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NormasSeeder extends Seeder
{
    public function run(): void
    {
        $normas = [
            ['tipo_norma_id' => 2, 'numero' => 'LEY-001/2026',  'titulo' => 'Ley Municipal de Presupuesto General Gestión 2026',        'estado_vigencia' => 'vigente',  'fecha_promulgacion' => '2026-01-05', 'tema_principal' => 'Finanzas Públicas',        'publicado_por' => 1],
            ['tipo_norma_id' => 2, 'numero' => 'LEY-002/2026',  'titulo' => 'Ley Municipal de Aprobación del POA 2026',                 'estado_vigencia' => 'vigente',  'fecha_promulgacion' => '2026-01-15', 'tema_principal' => 'Planificación',            'publicado_por' => 1],
            ['tipo_norma_id' => 2, 'numero' => 'LEY-003/2025',  'titulo' => 'Ley Municipal de Desarrollo Económico Local',              'estado_vigencia' => 'vigente',  'fecha_promulgacion' => '2025-06-15', 'tema_principal' => 'Desarrollo Productivo',   'publicado_por' => 1],
            ['tipo_norma_id' => 3, 'numero' => 'DEC-001/2026',  'titulo' => 'Decreto Municipal de Reorganización Administrativa',       'estado_vigencia' => 'vigente',  'fecha_promulgacion' => '2026-02-01', 'tema_principal' => 'Organización Institucional', 'publicado_por' => 1],
            ['tipo_norma_id' => 3, 'numero' => 'DEC-002/2026',  'titulo' => 'Decreto Municipal de Gestión Ambiental',                  'estado_vigencia' => 'vigente',  'fecha_promulgacion' => '2026-03-05', 'tema_principal' => 'Medio Ambiente',           'publicado_por' => 1],
            ['tipo_norma_id' => 3, 'numero' => 'DEC-003/2025',  'titulo' => 'Decreto Municipal de Regularización de Loteamientos',     'estado_vigencia' => 'vigente',  'fecha_promulgacion' => '2025-08-20', 'tema_principal' => 'Urbanismo',                'publicado_por' => 1],
            ['tipo_norma_id' => 4, 'numero' => 'RES-001/2026',  'titulo' => 'Resolución de Contratación Directa PROJ-2026-001',        'estado_vigencia' => 'vigente',  'fecha_promulgacion' => '2026-03-10', 'tema_principal' => 'Contrataciones',           'publicado_por' => 1],
            ['tipo_norma_id' => 4, 'numero' => 'RES-002/2026',  'titulo' => 'Resolución de Aprobación de Reglamento Interno de Personal', 'estado_vigencia' => 'vigente', 'fecha_promulgacion' => '2026-01-20', 'tema_principal' => 'Recursos Humanos',         'publicado_por' => 1],
            ['tipo_norma_id' => 5, 'numero' => 'ORD-001/2025',  'titulo' => 'Ordenanza Municipal de Tasas y Patentes Gestión 2025',    'estado_vigencia' => 'abrogada', 'fecha_promulgacion' => '2025-01-10', 'tema_principal' => 'Tasas y Patentes',         'publicado_por' => 1],
            ['tipo_norma_id' => 5, 'numero' => 'ORD-001/2026',  'titulo' => 'Ordenanza Municipal de Tasas y Patentes Gestión 2026',    'estado_vigencia' => 'vigente',  'fecha_promulgacion' => '2026-01-08', 'tema_principal' => 'Tasas y Patentes',         'publicado_por' => 1],
            ['tipo_norma_id' => 5, 'numero' => 'ORD-002/2026',  'titulo' => 'Ordenanza Municipal de Tránsito Urbano',                  'estado_vigencia' => 'vigente',  'fecha_promulgacion' => '2026-02-15', 'tema_principal' => 'Tránsito',                 'publicado_por' => 1],
            ['tipo_norma_id' => 6, 'numero' => 'CIRC-001/2026', 'titulo' => 'Circular sobre Procedimientos de Contratación Gubernamental', 'estado_vigencia' => 'vigente', 'fecha_promulgacion' => '2026-02-10', 'tema_principal' => 'Contrataciones',           'publicado_por' => 1],
        ];

        foreach ($normas as $n) {
            $n['slug'] = Str::slug($n['numero'].'-'.$n['titulo']);
            DB::table('normas')->insert($n);
        }
    }
}
