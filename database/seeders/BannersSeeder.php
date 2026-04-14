<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'titulo' => 'Bienvenidos al Gobierno Autónomo Municipal',
                'descripcion' => 'Trabajando por el bienestar y desarrollo sostenible de todos los ciudadanos del municipio.',
                'imagen_url' => env('APP_URL').'/storage/banners/banner-01.jpg',
                'enlace_url' => null,
                'activo' => true,
                'orden' => 1,
                'fecha_inicio' => null,
                'fecha_fin' => null,
            ],
            [
                'titulo' => 'Trámites en Línea',
                'descripcion' => 'Realiza tus trámites municipales de forma rápida y sencilla desde cualquier lugar.',
                'imagen_url' => env('APP_URL').'/storage/banners/banner-02.jpg',
                'enlace_url' => '/tramites',
                'activo' => true,
                'orden' => 2,
                'fecha_inicio' => null,
                'fecha_fin' => null,
            ],
            [
                'titulo' => 'Transparencia Municipal',
                'descripcion' => 'Accede a la información pública, presupuestos y rendición de cuentas de tu municipio.',
                'imagen_url' => env('APP_URL').'/storage/banners/banner-03.jpg',
                'enlace_url' => '/transparencia',
                'activo' => true,
                'orden' => 3,
                'fecha_inicio' => null,
                'fecha_fin' => null,
            ],
        ];

        DB::table('banners')->insert($banners);
    }
}
