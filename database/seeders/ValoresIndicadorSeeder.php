<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValoresIndicadorSeeder extends Seeder
{
    public function run(): void
    {
        $valores = [
            ['indicador_id' => 1, 'valor' => 18.5, 'mes' => 1, 'gestion' => 2026, 'fuente' => 'SICO - Sistema Contable Municipal',   'registrado_por' => 1],
            ['indicador_id' => 1, 'valor' => 35.2, 'mes' => 2, 'gestion' => 2026, 'fuente' => 'SICO - Sistema Contable Municipal',   'registrado_por' => 1],
            ['indicador_id' => 1, 'valor' => 52.8, 'mes' => 3, 'gestion' => 2026, 'fuente' => 'SICO - Sistema Contable Municipal',   'registrado_por' => 1],
            ['indicador_id' => 2, 'valor' => 850000, 'mes' => 1, 'gestion' => 2026, 'fuente' => 'Sistema de Recaudación Municipal', 'registrado_por' => 1],
            ['indicador_id' => 2, 'valor' => 920000, 'mes' => 2, 'gestion' => 2026, 'fuente' => 'Sistema de Recaudación Municipal', 'registrado_por' => 1],
            ['indicador_id' => 2, 'valor' => 1050000, 'mes' => 3, 'gestion' => 2026, 'fuente' => 'Sistema de Recaudación Municipal', 'registrado_por' => 1],
            ['indicador_id' => 3, 'valor' => 82.5, 'mes' => 3, 'gestion' => 2026, 'fuente' => 'EPSA Local', 'registrado_por' => 1],
            ['indicador_id' => 3, 'valor' => 80.1, 'mes' => 12, 'gestion' => 2025, 'fuente' => 'EPSA Local', 'registrado_por' => 1],
            ['indicador_id' => 4, 'valor' => 3.5, 'mes' => 3, 'gestion' => 2026, 'fuente' => 'Secretaría de Obras', 'registrado_por' => 1],
            ['indicador_id' => 5, 'valor' => 91.2, 'mes' => 12, 'gestion' => 2025, 'fuente' => 'Ministerio de Educación', 'registrado_por' => 1],
            ['indicador_id' => 6, 'valor' => 76.8, 'mes' => 3, 'gestion' => 2026, 'fuente' => 'Sistema SNIS', 'registrado_por' => 1],
            ['indicador_id' => 7, 'valor' => 88.4, 'mes' => 3, 'gestion' => 2026, 'fuente' => 'Secretaría de Salud', 'registrado_por' => 1],
            ['indicador_id' => 8, 'valor' => 1250, 'mes' => 3, 'gestion' => 2026, 'fuente' => 'Registro Municipal', 'registrado_por' => 1],
            ['indicador_id' => 9, 'valor' => 4.2, 'mes' => 12, 'gestion' => 2025, 'fuente' => 'Secretaría de Obras', 'registrado_por' => 1],
            ['indicador_id' => 10, 'valor' => 67.5, 'mes' => 6, 'gestion' => 2025, 'fuente' => 'Encuesta Municipal', 'registrado_por' => 1],
            ['indicador_id' => 11, 'valor' => 78.9, 'mes' => 3, 'gestion' => 2026, 'fuente' => 'Sistema de Trámites', 'registrado_por' => 1],
            ['indicador_id' => 12, 'valor' => 1, 'mes' => 3, 'gestion' => 2026, 'fuente' => 'Secretaría de Obras', 'registrado_por' => 1],
        ];

        foreach ($valores as $v) {
            DB::table('valores_indicador')->insert($v);
        }
    }
}
