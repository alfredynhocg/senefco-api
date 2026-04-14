<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuditoriasSeeder extends Seeder
{
    public function run(): void
    {
        $auditorias = [
            ['tipo_auditoria_id' => 1, 'codigo_auditoria' => 'AUD-FIN-2025-001', 'titulo' => 'Auditoría Financiera Gestión 2025 - Alcaldía Municipal',          'secretaria_auditada_id' => 1, 'objeto_examen' => 'Estados financieros y presupuestarios de la gestión 2025.',              'entidad_auditora' => 'Contraloría General del Estado', 'gestion_auditada' => 2025, 'fecha_inicio' => '2026-01-15', 'fecha_fin' => '2026-03-15', 'estado' => 'concluida', 'publico' => true,  'publicado_por' => 1],
            ['tipo_auditoria_id' => 1, 'codigo_auditoria' => 'AUD-FIN-2025-002', 'titulo' => 'Auditoría Financiera Secretaría de Finanzas 2025',               'secretaria_auditada_id' => 2, 'objeto_examen' => 'Operaciones financieras y contables de la Secretaría de Finanzas.',     'entidad_auditora' => 'Unidad de Auditoría Interna',    'gestion_auditada' => 2025, 'fecha_inicio' => '2026-02-01', 'fecha_fin' => '2026-03-30', 'estado' => 'en_ejecucion', 'publico' => true,  'publicado_por' => 1],
            ['tipo_auditoria_id' => 2, 'codigo_auditoria' => 'AUD-OBR-2025-001', 'titulo' => 'Auditoría a Obras Públicas - Proyectos de Infraestructura 2025', 'secretaria_auditada_id' => 3, 'objeto_examen' => 'Ejecución y liquidación de contratos de obras públicas.',                 'entidad_auditora' => 'Unidad de Auditoría Interna',    'gestion_auditada' => 2025, 'fecha_inicio' => '2026-02-15', 'fecha_fin' => null,         'estado' => 'en_ejecucion', 'publico' => false, 'publicado_por' => 1],
            ['tipo_auditoria_id' => 3, 'codigo_auditoria' => 'AUD-TI-2025-001',  'titulo' => 'Auditoría de Tecnologías de Información 2025',                   'secretaria_auditada_id' => 1, 'objeto_examen' => 'Sistemas de información y seguridad informática de la Alcaldía.',          'entidad_auditora' => 'Unidad de Auditoría Interna',    'gestion_auditada' => 2025, 'fecha_inicio' => '2026-01-20', 'fecha_fin' => '2026-02-28', 'estado' => 'concluida', 'publico' => false, 'publicado_por' => 1],
            ['tipo_auditoria_id' => 4, 'codigo_auditoria' => 'AUD-GES-2025-001', 'titulo' => 'Auditoría de Gestión - Secretaría de Educación 2025',            'secretaria_auditada_id' => 4, 'objeto_examen' => 'Eficiencia y eficacia en la gestión educativa municipal.',               'entidad_auditora' => 'Unidad de Auditoría Interna',    'gestion_auditada' => 2025, 'fecha_inicio' => '2025-11-01', 'fecha_fin' => '2026-01-31', 'estado' => 'concluida', 'publico' => true,  'publicado_por' => 1],
            ['tipo_auditoria_id' => 5, 'codigo_auditoria' => 'AUD-ESP-2026-001', 'titulo' => 'Auditoría Especial - Proceso de Adquisiciones T1-2026',          'secretaria_auditada_id' => null, 'objeto_examen' => 'Procesos de contratación y adquisiciones del primer trimestre 2026.', 'entidad_auditora' => 'Contraloría General del Estado', 'gestion_auditada' => 2026, 'fecha_inicio' => '2026-04-01', 'fecha_fin' => null,         'estado' => 'planificada', 'publico' => false, 'publicado_por' => 1],
        ];

        foreach ($auditorias as $a) {
            $a['slug'] = Str::slug($a['codigo_auditoria'].'-'.$a['titulo']);
            DB::table('auditorias')->insert($a);
        }
    }
}
