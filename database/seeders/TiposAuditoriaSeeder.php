<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposAuditoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos_auditoria')->insert([
            ['nombre' => 'Interna',       'descripcion' => 'Auditoría realizada por la Unidad de Auditoría Interna (UAI)',        'activo' => true],
            ['nombre' => 'Externa',       'descripcion' => 'Auditoría realizada por firma auditora externa o Contraloría',        'activo' => true],
            ['nombre' => 'Especial',      'descripcion' => 'Auditoría de propósito especial sobre área o proceso específico',     'activo' => true],
            ['nombre' => 'Operacional',   'descripcion' => 'Evaluación de eficiencia y eficacia de operaciones y procesos',       'activo' => true],
            ['nombre' => 'Financiera',    'descripcion' => 'Revisión de estados financieros y registros contables',              'activo' => true],
            ['nombre' => 'De Sistemas',   'descripcion' => 'Auditoría de sistemas informáticos y tecnología',                    'activo' => true],
        ]);
    }
}
