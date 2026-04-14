<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DecretosMunicipalesSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            // Decretos
            ['tipo' => 'decreto',    'numero' => 'DEC-001/2026', 'titulo' => 'Decreto Municipal de Reorganización de la Estructura Administrativa',     'descripcion' => 'Aprueba la nueva estructura orgánica de la Alcaldía Municipal para la gestión 2026.',                          'estado' => 'publicado', 'fecha_promulgacion' => '2026-01-10', 'anio' => 2026, 'publicado_en_web' => true,  'publicado_por' => 1],
            ['tipo' => 'decreto',    'numero' => 'DEC-002/2026', 'titulo' => 'Decreto Municipal de Aprobación del Plan de Contingencia Ambiental',         'descripcion' => 'Establece medidas de emergencia para la gestión de residuos sólidos y protección del medio ambiente.',  'estado' => 'publicado', 'fecha_promulgacion' => '2026-01-25', 'anio' => 2026, 'publicado_en_web' => true,  'publicado_por' => 1],
            ['tipo' => 'decreto',    'numero' => 'DEC-003/2026', 'titulo' => 'Decreto Municipal de Regularización de Asentamientos Humanos',               'descripcion' => 'Norma los procesos de regularización de asentamientos humanos en el área urbana y periurbana.',          'estado' => 'publicado', 'fecha_promulgacion' => '2026-02-05', 'anio' => 2026, 'publicado_en_web' => true,  'publicado_por' => 1],
            ['tipo' => 'decreto',    'numero' => 'DEC-004/2026', 'titulo' => 'Decreto Municipal de Incentivos para la Micro y Pequeña Empresa',            'descripcion' => 'Otorga beneficios tributarios y de simplificación de trámites para MiPyMEs registradas en el municipio.', 'estado' => 'publicado', 'fecha_promulgacion' => '2026-02-18', 'anio' => 2026, 'publicado_en_web' => true,  'publicado_por' => 1],
            ['tipo' => 'decreto',    'numero' => 'DEC-005/2025', 'titulo' => 'Decreto Municipal de Aprobación del Reglamento de Construcciones',           'descripcion' => 'Aprueba el reglamento técnico de construcción, urbanización y uso de suelo para el municipio.',         'estado' => 'publicado', 'fecha_promulgacion' => '2025-06-15', 'anio' => 2025, 'publicado_en_web' => true,  'publicado_por' => 1],

            // Resoluciones
            ['tipo' => 'resolucion', 'numero' => 'RES-001/2026', 'titulo' => 'Resolución de Aprobación del Reglamento Interno de Personal',                'descripcion' => 'Aprueba el reglamento interno que norma las relaciones laborales y disciplina del personal municipal.',  'estado' => 'publicado', 'fecha_promulgacion' => '2026-01-20', 'anio' => 2026, 'publicado_en_web' => true,  'publicado_por' => 1],
            ['tipo' => 'resolucion', 'numero' => 'RES-002/2026', 'titulo' => 'Resolución de Contratación Directa para Proyecto de Infraestructura Vial',   'descripcion' => 'Autoriza la contratación directa para la ejecución de obras de mejoramiento vial en el área urbana.',    'estado' => 'publicado', 'fecha_promulgacion' => '2026-03-10', 'anio' => 2026, 'publicado_en_web' => true,  'publicado_por' => 1],
            ['tipo' => 'resolucion', 'numero' => 'RES-003/2026', 'titulo' => 'Resolución de Aprobación del POA Reformulado 2026',                          'descripcion' => 'Aprueba la reformulación del Plan Operativo Anual 2026 en función a la disponibilidad presupuestaria.',   'estado' => 'publicado', 'fecha_promulgacion' => '2026-04-01', 'anio' => 2026, 'publicado_en_web' => true,  'publicado_por' => 1],
            ['tipo' => 'resolucion', 'numero' => 'RES-001/2025', 'titulo' => 'Resolución de Reconocimiento a Servidores Públicos Destacados 2025',          'descripcion' => 'Reconoce la labor de servidores públicos con desempeño sobresaliente durante la gestión 2025.',          'estado' => 'publicado', 'fecha_promulgacion' => '2025-12-20', 'anio' => 2025, 'publicado_en_web' => true,  'publicado_por' => 1],

            // Ordenanzas
            ['tipo' => 'ordenanza',  'numero' => 'ORD-001/2026', 'titulo' => 'Ordenanza Municipal de Tasas y Patentes Gestión 2026',                       'descripcion' => 'Establece las tasas municipales, patentes de funcionamiento y aranceles aplicables durante la gestión.',  'estado' => 'publicado', 'fecha_promulgacion' => '2026-01-08', 'anio' => 2026, 'publicado_en_web' => true,  'publicado_por' => 1],
            ['tipo' => 'ordenanza',  'numero' => 'ORD-002/2026', 'titulo' => 'Ordenanza Municipal de Tránsito y Seguridad Vial',                           'descripcion' => 'Norma la circulación vehicular, la seguridad vial y el uso del espacio público en el municipio.',         'estado' => 'publicado', 'fecha_promulgacion' => '2026-02-15', 'anio' => 2026, 'publicado_en_web' => true,  'publicado_por' => 1],
            ['tipo' => 'ordenanza',  'numero' => 'ORD-001/2025', 'titulo' => 'Ordenanza Municipal de Tasas y Patentes Gestión 2025',                       'descripcion' => 'Establece las tasas municipales, patentes de funcionamiento y aranceles aplicables durante la gestión.',  'estado' => 'publicado', 'fecha_promulgacion' => '2025-01-10', 'anio' => 2025, 'publicado_en_web' => true,  'publicado_por' => 1],
        ];

        foreach ($registros as $registro) {
            $registro['slug'] = Str::slug($registro['numero'].'-'.$registro['titulo']);
            DB::table('decretos_municipales')->insert($registro);
        }
    }
}
