<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultasCiudadanasSeeder extends Seeder
{
    public function run(): void
    {
        $consultas = [
            ['creado_por' => 1, 'pregunta' => '¿Está de acuerdo con la construcción de un nuevo mercado central en la ciudad?',               'descripcion' => 'Se propone construir un mercado central moderno que reemplaze las instalaciones actuales.',             'fecha_inicio' => '2026-03-01', 'fecha_fin' => '2026-03-31', 'activa' => false],
            ['creado_por' => 1, 'pregunta' => '¿Qué área de infraestructura debe priorizarse en el presupuesto 2027?',                        'descripcion' => 'Seleccione el área de infraestructura que considera más urgente para el próximo año.',                  'fecha_inicio' => '2026-03-15', 'fecha_fin' => '2026-04-15', 'activa' => true],
            ['creado_por' => 1, 'pregunta' => '¿Aprueba la implementación de un sistema de transporte público masivo (BRT)?',                 'descripcion' => 'El proyecto contempla la creación de carriles exclusivos para autobuses en las avenidas principales.',  'fecha_inicio' => '2026-04-01', 'fecha_fin' => '2026-04-30', 'activa' => true],
            ['creado_por' => 1, 'pregunta' => '¿Está de acuerdo con la restricción de circulación vehicular en el centro histórico?',         'descripcion' => 'La propuesta busca reducir el tráfico y contaminación en la zona histórica del municipio.',             'fecha_inicio' => '2026-02-01', 'fecha_fin' => '2026-02-28', 'activa' => false],
            ['creado_por' => 1, 'pregunta' => '¿Cuál es su nivel de satisfacción con los servicios municipales en el último año?',            'descripcion' => 'Encuesta de satisfacción ciudadana sobre los servicios prestados por la Alcaldía Municipal.',           'fecha_inicio' => '2026-03-20', 'fecha_fin' => '2026-04-20', 'activa' => true],
        ];

        foreach ($consultas as $c) {
            DB::table('consultas_ciudadanas')->insert($c);
        }
    }
}
