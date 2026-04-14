<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosProyectoSeeder extends Seeder
{
    public function run(): void
    {
        $estados = [
            ['nombre' => 'En diseño',      'color_hex' => '#6c757d', 'activo' => true],
            ['nombre' => 'Licitación',     'color_hex' => '#ffc107', 'activo' => true],
            ['nombre' => 'En ejecución',   'color_hex' => '#0d6efd', 'activo' => true],
            ['nombre' => 'Suspendido',     'color_hex' => '#dc3545', 'activo' => true],
            ['nombre' => 'Concluido',      'color_hex' => '#198754', 'activo' => true],
            ['nombre' => 'Observado',      'color_hex' => '#fd7e14', 'activo' => true],
        ];

        foreach ($estados as $estado) {
            DB::table('estados_proyecto')->insert($estado);
        }
    }
}
