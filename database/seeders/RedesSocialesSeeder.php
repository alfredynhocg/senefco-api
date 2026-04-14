<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\DisablesForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RedesSocialesSeeder extends Seeder
{
    use DisablesForeignKeys;

    public function run(): void
    {
        $this->disableForeignKeys();
        DB::table('redes_sociales')->truncate();
        $this->enableForeignKeys();

        DB::table('redes_sociales')->insert([
            [
                'plataforma' => 'facebook',
                'url' => 'https://www.facebook.com/senefcodeachocalla',
                'nombre_cuenta' => 'Alcaldía de Achocalla',
                'icono_clase' => 'fa-brands fa-facebook-f',
                'activo' => true,
                'orden' => 1,
            ],
            [
                'plataforma' => 'instagram',
                'url' => 'https://www.instagram.com/senefcodeachocalla',
                'nombre_cuenta' => '@senefcodeachocalla',
                'icono_clase' => 'fa-brands fa-instagram',
                'activo' => true,
                'orden' => 2,
            ],
            [
                'plataforma' => 'youtube',
                'url' => 'https://www.youtube.com/@senefcodeachocalla',
                'nombre_cuenta' => 'Alcaldía de Achocalla',
                'icono_clase' => 'fa-brands fa-youtube',
                'activo' => true,
                'orden' => 3,
            ],
            [
                'plataforma' => 'tiktok',
                'url' => 'https://www.tiktok.com/@senefcodeachocalla',
                'nombre_cuenta' => '@senefcodeachocalla',
                'icono_clase' => 'fa-brands fa-tiktok',
                'activo' => true,
                'orden' => 4,
            ],
        ]);
    }
}
