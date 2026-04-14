<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\DisablesForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubsenefcosSeeder extends Seeder
{
    use DisablesForeignKeys;

    public function run(): void
    {
        $this->disableForeignKeys();
        DB::table('subsenefcos')->truncate();
        $this->enableForeignKeys();

        $subsenefcos = [
            [
                'nombre' => 'Subalcaldía Ciudad Satélite',
                'zona_cobertura' => 'Ciudad Satélite, Villa Adela, Pacajes, Senkata',
                'direccion_fisica' => 'Av. 6 de Marzo, Ciudad Satélite, El Alto',
                'telefono' => '+591 2 2840001',
                'email' => 'subsenefco.satelite@elalto.gob.bo',
                'imagen_url' => null,
                'latitud' => -16.4980,
                'longitud' => -68.1760,
                'tramites_disponibles' => 'Certificaciones, Licencias de funcionamiento, Trámites catastrales, Permisos de construcción',
                'activa' => true,
            ],
            [
                'nombre' => 'Subalcaldía Villa Dolores',
                'zona_cobertura' => 'Villa Dolores, 16 de Julio, Germán Busch, Rosas Pampa',
                'direccion_fisica' => 'Av. Bolivia, Villa Dolores, El Alto',
                'telefono' => '+591 2 2840002',
                'email' => 'subsenefco.villadolores@elalto.gob.bo',
                'imagen_url' => null,
                'latitud' => -16.5050,
                'longitud' => -68.1870,
                'tramites_disponibles' => 'Certificaciones, Pagos municipales, Licencias de actividad económica',
                'activa' => true,
            ],
            [
                'nombre' => 'Subalcaldía Río Seco',
                'zona_cobertura' => 'Río Seco, El Kenko, Santiago II, Mercado Río Seco',
                'direccion_fisica' => 'Calle Principal Río Seco, El Alto',
                'telefono' => '+591 2 2840003',
                'email' => 'subsenefco.rioseco@elalto.gob.bo',
                'imagen_url' => null,
                'latitud' => -16.4750,
                'longitud' => -68.1980,
                'tramites_disponibles' => 'Certificaciones, Trámites de terrenos, Permisos eventuales',
                'activa' => true,
            ],
            [
                'nombre' => 'Subalcaldía Zona Franca',
                'zona_cobertura' => 'Zona Franca, Mercado 16 de Julio, Villa Ingenio',
                'direccion_fisica' => 'Av. Juan Pablo II, Zona Franca, El Alto',
                'telefono' => '+591 2 2840004',
                'email' => 'subsenefco.zonafranca@elalto.gob.bo',
                'imagen_url' => null,
                'latitud' => -16.5100,
                'longitud' => -68.1650,
                'tramites_disponibles' => 'Certificaciones, Licencias comerciales, Pagos de impuestos municipales',
                'activa' => true,
            ],
            [
                'nombre' => 'Subalcaldía Santiago de Llallagua',
                'zona_cobertura' => 'Santiago de Llallagua, Ballivián, El Tejar, Cosmos 79',
                'direccion_fisica' => 'Av. Cosmos, Santiago de Llallagua, El Alto',
                'telefono' => '+591 2 2840005',
                'email' => 'subsenefco.santiago@elalto.gob.bo',
                'imagen_url' => null,
                'latitud' => -16.5220,
                'longitud' => -68.1720,
                'tramites_disponibles' => 'Certificaciones, Permisos de construcción, Trámites catastrales',
                'activa' => true,
            ],
            [
                'nombre' => 'Subalcaldía Hampaturi',
                'zona_cobertura' => 'Hampaturi, Milluni, Pongo, Wila Jawira',
                'direccion_fisica' => 'Plaza Principal Hampaturi, El Alto',
                'telefono' => '+591 2 2840006',
                'email' => 'subsenefco.hampaturi@elalto.gob.bo',
                'imagen_url' => null,
                'latitud' => -16.4420,
                'longitud' => -68.1100,
                'tramites_disponibles' => 'Certificaciones, Trámites agrarios, Permisos comunales',
                'activa' => true,
            ],
            [
                'nombre' => 'Subalcaldía Villa Exaltación',
                'zona_cobertura' => 'Villa Exaltación, Las Flores, El Porvenir, Kantutani',
                'direccion_fisica' => 'Calle Exaltación s/n, El Alto',
                'telefono' => '+591 2 2840007',
                'email' => 'subsenefco.exaltacion@elalto.gob.bo',
                'imagen_url' => null,
                'latitud' => -16.5300,
                'longitud' => -68.1800,
                'tramites_disponibles' => 'Certificaciones, Licencias de funcionamiento, Permisos eventuales',
                'activa' => true,
            ],
        ];

        foreach ($subsenefcos as $data) {
            $data['slug'] = Str::slug($data['nombre']);
            DB::table('subsenefcos')->insert($data);
        }
    }
}
