<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class POASeeder extends Seeder
{
    public function run(): void
    {
        $poas = [
            ['plan_gobierno_id' => 2, 'secretaria_id' => 1, 'gestion' => 2026, 'titulo' => 'POA 2026 - Alcaldía Municipal',              'estado' => 'aprobado', 'fecha_aprobacion' => '2026-01-15', 'aprobado_por' => 1, 'documento_pdf_url' => 'https://senefco.gob.bo/poa/senefco-2026.pdf'],
            ['plan_gobierno_id' => 2, 'secretaria_id' => 2, 'gestion' => 2026, 'titulo' => 'POA 2026 - Secretaría de Finanzas',          'estado' => 'aprobado', 'fecha_aprobacion' => '2026-01-15', 'aprobado_por' => 1, 'documento_pdf_url' => 'https://senefco.gob.bo/poa/finanzas-2026.pdf'],
            ['plan_gobierno_id' => 2, 'secretaria_id' => 3, 'gestion' => 2026, 'titulo' => 'POA 2026 - Secretaría de Obras Públicas',    'estado' => 'aprobado', 'fecha_aprobacion' => '2026-01-15', 'aprobado_por' => 1, 'documento_pdf_url' => 'https://senefco.gob.bo/poa/obras-2026.pdf'],
            ['plan_gobierno_id' => 2, 'secretaria_id' => 4, 'gestion' => 2026, 'titulo' => 'POA 2026 - Educación y Cultura',             'estado' => 'aprobado', 'fecha_aprobacion' => '2026-01-15', 'aprobado_por' => 1, 'documento_pdf_url' => 'https://senefco.gob.bo/poa/educacion-2026.pdf'],
            ['plan_gobierno_id' => 2, 'secretaria_id' => 5, 'gestion' => 2026, 'titulo' => 'POA 2026 - Secretaría de Salud',             'estado' => 'aprobado', 'fecha_aprobacion' => '2026-01-15', 'aprobado_por' => 1, 'documento_pdf_url' => 'https://senefco.gob.bo/poa/salud-2026.pdf'],
            ['plan_gobierno_id' => 2, 'secretaria_id' => 6, 'gestion' => 2026, 'titulo' => 'POA 2026 - Planificación Estratégica',       'estado' => 'aprobado', 'fecha_aprobacion' => '2026-01-15', 'aprobado_por' => 1, 'documento_pdf_url' => 'https://senefco.gob.bo/poa/planificacion-2026.pdf'],
            ['plan_gobierno_id' => 2, 'secretaria_id' => 7, 'gestion' => 2026, 'titulo' => 'POA 2026 - Desarrollo Productivo',           'estado' => 'aprobado', 'fecha_aprobacion' => '2026-01-15', 'aprobado_por' => 1, 'documento_pdf_url' => 'https://senefco.gob.bo/poa/desarrollo-2026.pdf'],
            ['plan_gobierno_id' => 2, 'secretaria_id' => 8, 'gestion' => 2026, 'titulo' => 'POA 2026 - Secretaría Jurídica',             'estado' => 'aprobado', 'fecha_aprobacion' => '2026-01-15', 'aprobado_por' => 1, 'documento_pdf_url' => 'https://senefco.gob.bo/poa/juridica-2026.pdf'],
        ];

        foreach ($poas as $poa) {
            DB::table('poa')->insert($poa);
        }
    }
}
