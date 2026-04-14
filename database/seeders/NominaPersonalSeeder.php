<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NominaPersonalSeeder extends Seeder
{
    public function run(): void
    {
        $personal = [
            ['secretaria_id' => 1, 'nombre' => 'Carlos',    'apellido' => 'Mamani Quispe',     'ci' => '1234567', 'cargo' => 'Alcalde Municipal',              'nivel_salarial' => 'Autoridad', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 1, 'nombre' => 'Lucía',     'apellido' => 'Flores Condori',    'ci' => '2345678', 'cargo' => 'Secretaria General',             'nivel_salarial' => 'Ejecutivo', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 1, 'nombre' => 'Roberto',   'apellido' => 'Choque Limachi',    'ci' => '3456789', 'cargo' => 'Asesor Legal',                   'nivel_salarial' => 'Técnico I', 'tipo_contrato' => 'consultor', 'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 2, 'nombre' => 'María',     'apellido' => 'Huanca Apaza',      'ci' => '4567890', 'cargo' => 'Directora de Finanzas',          'nivel_salarial' => 'Ejecutivo', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 2, 'nombre' => 'Jorge',     'apellido' => 'Ticona Vargas',     'ci' => '5678901', 'cargo' => 'Contador General',               'nivel_salarial' => 'Técnico I', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 2, 'nombre' => 'Ana',       'apellido' => 'Calle Ramos',       'ci' => '6789012', 'cargo' => 'Analista Presupuestario',        'nivel_salarial' => 'Técnico II', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 2, 'nombre' => 'Pedro',     'apellido' => 'Quispe Morales',    'ci' => '7890123', 'cargo' => 'Auxiliar Contable',              'nivel_salarial' => 'Auxiliar',  'tipo_contrato' => 'eventual',  'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 3, 'nombre' => 'Marco',     'apellido' => 'Ramos Huallpa',     'ci' => '8901234', 'cargo' => 'Director de Obras Públicas',     'nivel_salarial' => 'Ejecutivo', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 3, 'nombre' => 'Sandra',    'apellido' => 'Tarqui Callisaya',  'ci' => '9012345', 'cargo' => 'Ingeniera de Proyectos',         'nivel_salarial' => 'Técnico I', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 3, 'nombre' => 'Luis',      'apellido' => 'Merma Coaquira',    'ci' => '0123456', 'cargo' => 'Supervisor de Obras',            'nivel_salarial' => 'Técnico II', 'tipo_contrato' => 'consultor', 'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 4, 'nombre' => 'Elena',     'apellido' => 'Yapura Mamani',     'ci' => '1234568', 'cargo' => 'Directora de Educación',         'nivel_salarial' => 'Ejecutivo', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 4, 'nombre' => 'Hugo',      'apellido' => 'Colque Layme',      'ci' => '2345679', 'cargo' => 'Técnico en Cultura',             'nivel_salarial' => 'Técnico II', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 5, 'nombre' => 'Pablo',     'apellido' => 'Sucasaca Chura',    'ci' => '3456780', 'cargo' => 'Director de Salud',              'nivel_salarial' => 'Ejecutivo', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 5, 'nombre' => 'Carmen',    'apellido' => 'Pari Quispe',       'ci' => '4567891', 'cargo' => 'Técnica en Salud Pública',       'nivel_salarial' => 'Técnico I', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 6, 'nombre' => 'Silvia',    'apellido' => 'Quispe Apaza',      'ci' => '5678902', 'cargo' => 'Directora de Planificación',     'nivel_salarial' => 'Ejecutivo', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 6, 'nombre' => 'Raúl',      'apellido' => 'Tito Mamani',       'ci' => '6789013', 'cargo' => 'Técnico en Estadística',         'nivel_salarial' => 'Técnico II', 'tipo_contrato' => 'consultor', 'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 7, 'nombre' => 'David',     'apellido' => 'Chura Calcina',     'ci' => '7890124', 'cargo' => 'Director de Desarrollo Productivo', 'nivel_salarial' => 'Ejecutivo', 'tipo_contrato' => 'planta',   'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 7, 'nombre' => 'Rosa',      'apellido' => 'Catari Ticona',     'ci' => '8901235', 'cargo' => 'Promotora de Microempresas',     'nivel_salarial' => 'Técnico II', 'tipo_contrato' => 'eventual',  'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 8, 'nombre' => 'César',     'apellido' => 'Llanque Corimayo',  'ci' => '9012346', 'cargo' => 'Director Jurídico',              'nivel_salarial' => 'Ejecutivo', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
            ['secretaria_id' => 8, 'nombre' => 'Patricia',  'apellido' => 'Marca Ajata',       'ci' => '0123457', 'cargo' => 'Abogada Municipal',              'nivel_salarial' => 'Técnico I', 'tipo_contrato' => 'planta',    'gestion' => 2026, 'activo' => true],
        ];

        foreach ($personal as $p) {
            DB::table('nomina_personal')->insert($p);
        }
    }
}
