<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposNormaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos_norma')->insert([
            [
                'nombre' => 'Ley Municipal Autonómica',
                'sigla' => 'LMA',
                'descripcion' => 'Norma de mayor jerarquía del gobierno autónomo municipal',
                'activo' => true,
                'slug' => 'ley-municipal-autonomica',
            ],
            [
                'nombre' => 'Decreto Municipal',
                'sigla' => 'DM',
                'descripcion' => 'Norma emitida por el Órgano Ejecutivo Municipal',
                'activo' => true,
                'slug' => 'decreto-municipal',
            ],
            [
                'nombre' => 'Resolución Ejecutiva',
                'sigla' => 'RE',
                'descripcion' => 'Resolución emitida por la Alcaldía Municipal',
                'activo' => true,
                'slug' => 'resolucion-ejecutiva',
            ],
            [
                'nombre' => 'Resolución del Concejo Municipal',
                'sigla' => 'RCM',
                'descripcion' => 'Resolución emitida por el Concejo Municipal',
                'activo' => true,
                'slug' => 'resolucion-concejo-municipal',
            ],
            [
                'nombre' => 'Reglamento',
                'sigla' => 'REG',
                'descripcion' => 'Reglamento interno o sectorial',
                'activo' => true,
                'slug' => 'reglamento',
            ],
            [
                'nombre' => 'Ordenanza Municipal',
                'sigla' => 'ORD',
                'descripcion' => 'Ordenanza de aplicación general en el municipio',
                'activo' => true,
                'slug' => 'ordenanza-municipal',
            ],
            [
                'nombre' => 'Instructivo',
                'sigla' => 'INS',
                'descripcion' => 'Instrucción técnica o administrativa interna',
                'activo' => true,
                'slug' => 'instructivo',
            ],
        ]);
    }
}
