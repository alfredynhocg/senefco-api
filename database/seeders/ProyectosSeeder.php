<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProyectosSeeder extends Seeder
{
    public function run(): void
    {
        $proyectos = [
            ['codigo_sipfe' => 'SIPFE-2026-001', 'estado_id' => 3, 'secretaria_id' => 3, 'nombre' => 'Mejoramiento Vial Avenida Principal - Tramo I',          'descripcion' => 'Pavimentación y mejoramiento de 3.5 km de la avenida principal del municipio.',           'presupuesto_total' => 2800000.00, 'ubicacion_texto' => 'Avenida Principal, Tramo Centro-Norte', 'contratista' => 'Constructora Andina SRL',       'fecha_inicio_estimada' => '2026-02-01', 'fecha_fin_estimada' => '2026-08-30', 'publico' => true],
            ['codigo_sipfe' => 'SIPFE-2026-002', 'estado_id' => 3, 'secretaria_id' => 3, 'nombre' => 'Construcción Centro de Salud Zona Norte',                  'descripcion' => 'Construcción de nuevo centro de salud de primer nivel para atención de 15.000 habitantes.', 'presupuesto_total' => 4500000.00, 'ubicacion_texto' => 'Zona Norte, UV-45',              'contratista' => 'Constructora del Sur SA',      'fecha_inicio_estimada' => '2026-01-15', 'fecha_fin_estimada' => '2026-12-15', 'publico' => true],
            ['codigo_sipfe' => 'SIPFE-2026-003', 'estado_id' => 2, 'secretaria_id' => 4, 'nombre' => 'Construcción Escuela Municipal Barrio Los Pinos',          'descripcion' => 'Construcción de unidad educativa con 12 aulas, laboratorios y cancha deportiva.',          'presupuesto_total' => 3200000.00, 'ubicacion_texto' => 'Barrio Los Pinos, UV-23',        'contratista' => null,                           'fecha_inicio_estimada' => '2026-05-01', 'fecha_fin_estimada' => '2027-02-28', 'publico' => true],
            ['codigo_sipfe' => 'SIPFE-2026-004', 'estado_id' => 3, 'secretaria_id' => 3, 'nombre' => 'Alcantarillado Sanitario Zonas Periurbanas',               'descripcion' => 'Instalación de red de alcantarillado en 4 zonas periurbanas del municipio.',               'presupuesto_total' => 6100000.00, 'ubicacion_texto' => 'Zonas 12, 14, 18 y 22 periurbanas', 'contratista' => 'Ingeniería Hídrica Bolivia SA',  'fecha_inicio_estimada' => '2026-03-01', 'fecha_fin_estimada' => '2026-11-30', 'publico' => true],
            ['codigo_sipfe' => 'SIPFE-2025-005', 'estado_id' => 5, 'secretaria_id' => 5, 'nombre' => 'Equipamiento Centro de Salud Zona Sur',                    'descripcion' => 'Equipamiento médico completo para el centro de salud de la zona sur.',                     'presupuesto_total' => 850000.00,  'ubicacion_texto' => 'Zona Sur, UV-8',                'contratista' => 'Suministros Médicos SRL',       'fecha_inicio_estimada' => '2025-06-01', 'fecha_fin_estimada' => '2025-12-31', 'publico' => true],
            ['codigo_sipfe' => 'SIPFE-2026-006', 'estado_id' => 1, 'secretaria_id' => 7, 'nombre' => 'Infraestructura para Mercado Municipal Nuevo',              'descripcion' => 'Diseño y construcción de nuevo mercado municipal con 200 puestos comerciales.',            'presupuesto_total' => 7500000.00, 'ubicacion_texto' => 'Zona Central, terreno municipal', 'contratista' => null,                           'fecha_inicio_estimada' => '2026-08-01', 'fecha_fin_estimada' => '2027-12-31', 'publico' => true],
            ['codigo_sipfe' => 'SIPFE-2026-007', 'estado_id' => 3, 'secretaria_id' => 3, 'nombre' => 'Parque Recreativo Barrio El Molino',                       'descripcion' => 'Construcción de parque con áreas verdes, juegos infantiles y cancha deportiva.',           'presupuesto_total' => 380000.00,  'ubicacion_texto' => 'Barrio El Molino',              'contratista' => 'Paisajismo Municipal SA',       'fecha_inicio_estimada' => '2026-03-15', 'fecha_fin_estimada' => '2026-07-31', 'publico' => true],
            ['codigo_sipfe' => 'SIPFE-2026-008', 'estado_id' => 4, 'secretaria_id' => 3, 'nombre' => 'Electrificación Rural Comunidades Dispersas',               'descripcion' => 'Extensión de red eléctrica a 8 comunidades rurales del municipio.',                        'presupuesto_total' => 2100000.00, 'ubicacion_texto' => 'Comunidades rurales zona norte', 'contratista' => 'Electrotécnica Andina SRL',     'fecha_inicio_estimada' => '2026-01-10', 'fecha_fin_estimada' => '2026-09-30', 'publico' => false],
        ];

        foreach ($proyectos as $p) {
            $p['slug'] = Str::slug($p['nombre']);
            DB::table('proyectos')->insert($p);
        }
    }
}
