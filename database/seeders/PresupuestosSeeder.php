<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresupuestosSeeder extends Seeder
{
    public function run(): void
    {
        $presupuestos = [
            ['secretaria_id' => 1, 'gestion' => 2026, 'monto_aprobado' => 8500000.00,  'monto_modificado' => null,        'estado' => 'aprobado',  'documento_url' => 'https://senefco.gob.bo/presupuestos/senefco-2026.pdf',    'fecha_aprobacion' => '2026-01-10', 'aprobado_por' => 1],
            ['secretaria_id' => 2, 'gestion' => 2026, 'monto_aprobado' => 12000000.00, 'monto_modificado' => null,        'estado' => 'aprobado',  'documento_url' => 'https://senefco.gob.bo/presupuestos/finanzas-2026.pdf',    'fecha_aprobacion' => '2026-01-10', 'aprobado_por' => 1],
            ['secretaria_id' => 3, 'gestion' => 2026, 'monto_aprobado' => 15000000.00, 'monto_modificado' => 15500000.00, 'estado' => 'modificado', 'documento_url' => 'https://senefco.gob.bo/presupuestos/obras-2026.pdf',      'fecha_aprobacion' => '2026-01-10', 'aprobado_por' => 1],
            ['secretaria_id' => 4, 'gestion' => 2026, 'monto_aprobado' => 6000000.00,  'monto_modificado' => null,        'estado' => 'aprobado',  'documento_url' => 'https://senefco.gob.bo/presupuestos/educacion-2026.pdf',  'fecha_aprobacion' => '2026-01-10', 'aprobado_por' => 1],
            ['secretaria_id' => 5, 'gestion' => 2026, 'monto_aprobado' => 7500000.00,  'monto_modificado' => null,        'estado' => 'aprobado',  'documento_url' => 'https://senefco.gob.bo/presupuestos/salud-2026.pdf',      'fecha_aprobacion' => '2026-01-10', 'aprobado_por' => 1],
            ['secretaria_id' => 6, 'gestion' => 2026, 'monto_aprobado' => 3500000.00,  'monto_modificado' => null,        'estado' => 'aprobado',  'documento_url' => 'https://senefco.gob.bo/presupuestos/planificacion-2026.pdf', 'fecha_aprobacion' => '2026-01-10', 'aprobado_por' => 1],
            ['secretaria_id' => 7, 'gestion' => 2026, 'monto_aprobado' => 9000000.00,  'monto_modificado' => null,        'estado' => 'aprobado',  'documento_url' => 'https://senefco.gob.bo/presupuestos/desarrollo-2026.pdf', 'fecha_aprobacion' => '2026-01-10', 'aprobado_por' => 1],
            ['secretaria_id' => 8, 'gestion' => 2026, 'monto_aprobado' => 4000000.00,  'monto_modificado' => null,        'estado' => 'aprobado',  'documento_url' => 'https://senefco.gob.bo/presupuestos/juridica-2026.pdf',   'fecha_aprobacion' => '2026-01-10', 'aprobado_por' => 1],
            ['secretaria_id' => 2, 'gestion' => 2025, 'monto_aprobado' => 11000000.00, 'monto_modificado' => 11200000.00, 'estado' => 'cerrado',   'documento_url' => 'https://senefco.gob.bo/presupuestos/finanzas-2025.pdf',  'fecha_aprobacion' => '2025-01-08', 'aprobado_por' => 1],
            ['secretaria_id' => 3, 'gestion' => 2025, 'monto_aprobado' => 14000000.00, 'monto_modificado' => null,        'estado' => 'cerrado',   'documento_url' => 'https://senefco.gob.bo/presupuestos/obras-2025.pdf',    'fecha_aprobacion' => '2025-01-08', 'aprobado_por' => 1],
        ];

        foreach ($presupuestos as $p) {
            DB::table('presupuestos')->insert($p);
        }
    }
}
