<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\DisablesForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HimnosSeeder extends Seeder
{
    use DisablesForeignKeys;

    public function run(): void
    {
        $this->disableForeignKeys();
        DB::table('himnos')->truncate();
        $this->enableForeignKeys();

        DB::table('himnos')->insert([
            [
                'tipo' => 'municipal',
                'titulo' => 'Himno Municipal de Achocalla',
                'letra' => 'Texto de ejemplo del himno municipal de Achocalla. Reemplázalo con la letra oficial si está disponible.',
                'autor_letra' => 'Autor de la letra',
                'autor_musica' => 'Autor de la música',
                'audio_url' => 'https://example.com/audio/himno-municipal-achocalla.mp3',
                'partitura_url' => 'https://example.com/partitura/himno-municipal-achocalla.pdf',
                'imagen_url' => 'https://example.com/images/himno-achocalla.jpg',
                'descripcion' => 'Himno oficial del municipio de Achocalla.',
                'orden' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
