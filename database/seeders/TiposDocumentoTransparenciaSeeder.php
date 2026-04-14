<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDocumentoTransparenciaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos_documento_transparencia')->insert([
            ['nombre' => 'Declaración Jurada de Bienes',    'activo' => true],
            ['nombre' => 'Contratos y Licitaciones',        'activo' => true],
            ['nombre' => 'Informe de Gestión',              'activo' => true],
            ['nombre' => 'Nómina de Personal',              'activo' => true],
            ['nombre' => 'Presupuesto Aprobado',            'activo' => true],
            ['nombre' => 'Ejecución Presupuestaria',        'activo' => true],
            ['nombre' => 'Informe de Auditoría',            'activo' => true],
            ['nombre' => 'Actas de Concejo Municipal',      'activo' => true],
            ['nombre' => 'Plan Operativo Anual (POA)',      'activo' => true],
            ['nombre' => 'Reglamentos Internos',            'activo' => true],
            ['nombre' => 'Estadísticas e Indicadores',     'activo' => true],
            ['nombre' => 'Memoria Anual',                   'activo' => true],
        ]);
    }
}
