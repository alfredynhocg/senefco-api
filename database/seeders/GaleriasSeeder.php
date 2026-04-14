<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleriasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('galeria_items')->delete();
        DB::table('galerias')->delete();

        $galeriaId = DB::table('galerias')->insertGetId([
            'titulo' => 'Galería Municipal - Achocalla',
            'descripcion' => 'Registro fotográfico del municipio de Achocalla: obras, infraestructura, espacios naturales y actividades del Gobierno Autónomo Municipal.',
            'portada_url' => '/assets/img/galeria/imag1.jpg',
            'tipo' => 'fotos',
            'orden' => 1,
            'activo' => true,
            'created_at' => now(),
        ]);

        $items = [
            ['orden' => 1,  'file' => 'imag1',  'titulo' => 'Edificio Municipal de Achocalla',           'descripcion' => 'Sede principal del Gobierno Autónomo Municipal de Achocalla.'],
            ['orden' => 2,  'file' => 'imag2',  'titulo' => 'Plaza Central del Municipio',               'descripcion' => 'Plaza principal y centro cívico del municipio de Achocalla.'],
            ['orden' => 3,  'file' => 'imag3',  'titulo' => 'Infraestructura Municipal',                 'descripcion' => 'Obras de infraestructura y desarrollo urbano en Achocalla.'],
            ['orden' => 4,  'file' => 'imag4',  'titulo' => 'Centro Cívico de Achocalla',                'descripcion' => 'Espacio público de encuentro y actividades ciudadanas.'],
            ['orden' => 5,  'file' => 'imag5',  'titulo' => 'Instalaciones Deportivas Municipales',      'descripcion' => 'Áreas deportivas al servicio de la comunidad achocallense.'],
            ['orden' => 6,  'file' => 'imag6',  'titulo' => 'Laguna de Achocalla',                       'descripcion' => 'Reserva natural y espejo de agua del municipio de Achocalla.'],
            ['orden' => 7,  'file' => 'imag7',  'titulo' => 'Parque Ecológico Municipal',                'descripcion' => 'Áreas verdes y espacios naturales preservados por el municipio.'],
            ['orden' => 8,  'file' => 'imag8',  'titulo' => 'Atractivo Turístico - Lago Achocalla',      'descripcion' => 'Embarcaciones y zona recreativa a orillas de la laguna de Achocalla.'],
            ['orden' => 9,  'file' => 'imag9',  'titulo' => 'Señalética Turística Municipal',            'descripcion' => 'Señalización turística del municipio de Achocalla.'],
            ['orden' => 10, 'file' => 'imag10', 'titulo' => 'Zona Lacustre de Achocalla',                'descripcion' => 'Paisaje natural del entorno lacustre del municipio.'],
            ['orden' => 11, 'file' => 'imag11', 'titulo' => 'Área Recreativa Orillas del Lago',          'descripcion' => 'Botes y zona de recreación a orillas de la laguna municipal.'],
            ['orden' => 12, 'file' => 'imag12', 'titulo' => 'Paisaje Natural - Achocalla',               'descripcion' => 'Vista panorámica del entorno natural y lacustre del municipio.'],
        ];

        foreach ($items as $item) {
            $url = '/assets/img/galeria/'.$item['file'].'.jpg';
            DB::table('galeria_items')->insert([
                'galeria_id' => $galeriaId,
                'tipo' => 'foto',
                'url' => $url,
                'thumbnail_url' => $url,
                'titulo' => $item['titulo'],
                'descripcion' => $item['descripcion'],
                'orden' => $item['orden'],
                'created_at' => now(),
            ]);
        }
    }
}
