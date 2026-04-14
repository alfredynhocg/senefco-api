<?php

namespace Database\Seeders;

use App\Infrastructure\InformesAuditoria\Models\InformeAuditoria;
use Illuminate\Database\Seeder;

class InformesAuditoriaSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            [
                'nombre'           => 'Informe de Auditoría Financiera 2024',
                'descripcion'      => 'Auditoría financiera de los estados contables de la gestión 2024 de la Alcaldía Municipal.',
                'estado'           => 'publicado',
                'fecha'            => '2025-01-15',
                'anio'             => 2024,
                'publicado_en_web' => true,
            ],
            [
                'nombre'           => 'Informe de Auditoría Operacional – Servicios Municipales 2024',
                'descripcion'      => 'Evaluación de la eficiencia y eficacia en la prestación de servicios municipales durante el periodo 2024.',
                'estado'           => 'publicado',
                'fecha'            => '2025-02-10',
                'anio'             => 2024,
                'publicado_en_web' => true,
            ],
            [
                'nombre'           => 'Informe de Auditoría de Gestión – Proyectos de Inversión 2023',
                'descripcion'      => 'Auditoría de gestión de los proyectos de inversión pública ejecutados durante la gestión 2023.',
                'estado'           => 'publicado',
                'fecha'            => '2024-03-20',
                'anio'             => 2023,
                'publicado_en_web' => true,
            ],
            [
                'nombre'           => 'Informe Especial de Auditoría – Adquisiciones y Contrataciones 2023',
                'descripcion'      => 'Informe especial sobre los procesos de contratación de bienes y servicios durante el primer semestre 2023.',
                'estado'           => 'publicado',
                'fecha'            => '2024-05-05',
                'anio'             => 2023,
                'publicado_en_web' => true,
            ],
            [
                'nombre'           => 'Informe de Seguimiento de Recomendaciones 2022',
                'descripcion'      => 'Seguimiento al cumplimiento de las recomendaciones emitidas en las auditorías de la gestión 2022.',
                'estado'           => 'publicado',
                'fecha'            => '2023-06-30',
                'anio'             => 2022,
                'publicado_en_web' => true,
            ],
            [
                'nombre'           => 'Informe de Auditoría Financiera 2025 – Borrador',
                'descripcion'      => 'Borrador del informe de auditoría financiera correspondiente a la gestión 2025 (en revisión).',
                'estado'           => 'borrador',
                'fecha'            => null,
                'anio'             => 2025,
                'publicado_en_web' => false,
            ],
        ];

        foreach ($registros as $datos) {
            InformeAuditoria::create($datos);
        }
    }
}
