<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\DisablesForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoriaMunicipioSeeder extends Seeder
{
    use DisablesForeignKeys;

    public function run(): void
    {
        $this->disableForeignKeys();
        DB::table('historia_municipio')->truncate();
        $this->enableForeignKeys();

        DB::table('historia_municipio')->insert([
            [
                'titulo' => 'Época Pre-Incaica e Incaica',
                'contenido' => 'El territorio de Achocalla estuvo habitado originalmente por culturas locales que formaban parte del señorío Aymara de los Pacajes. Durante el periodo de expansión del Imperio Incaico, la región fue integrada al Tawantinsuyu, sirviendo como un punto estratégico de producción agrícola y conexión entre el altiplano y los valles.',
                'fecha_inicio' => '1000 AC',
                'fecha_fin' => '1535 DC',
                'imagen_url' => 'https://api.senefco.gob.bo/storage/historia/epoca_incaica.jpg',
                'orden' => 1,
                'activo' => true,
                'created_at' => now(),
            ],
            [
                'titulo' => 'Periodo Colonial',
                'contenido' => 'Con la llegada de los españoles, se establecieron encomiendas en la zona. Achocalla fue reconocida por su riqueza acuífera y sus lagunas, convirtiéndose en un lugar de descanso para los viajeros que se dirigían a la ciudad de Nuestra Señora de La Paz. Durante este tiempo se construyeron las primeras Iglesias y casonas de estilo colonial.',
                'fecha_inicio' => '1538',
                'fecha_fin' => '1825',
                'imagen_url' => 'https://api.senefco.gob.bo/storage/historia/epoca_colonial.jpg',
                'orden' => 2,
                'activo' => true,
                'created_at' => now(),
            ],
            [
                'titulo' => 'Creación de la Sección Municipal',
                'contenido' => 'El municipio de Achocalla fue creado como la Tercera Sección Municipal de la Provincia Murillo del Departamento de La Paz. Su creación formal marcó el inicio de una etapa de desarrollo institucional orientado a la prestación de servicios básicos y la mejora de la infraestructura vial para conectar sus diversas comunidades.',
                'fecha_inicio' => '1947',
                'fecha_fin' => 'Presente',
                'imagen_url' => 'https://api.senefco.gob.bo/storage/historia/creacion_municipio.jpg',
                'orden' => 3,
                'activo' => true,
                'created_at' => now(),
            ],
            [
                'titulo' => 'Achocalla en la Actualidad',
                'contenido' => 'Hoy en día, Achocalla se destaca como un municipio ecológico y turístico, conocido como la "Huerta de La Paz". Sus lagunas y su microclima lo convierten en un destino predilecto para el esparcimiento. La gestión municipal se enfoca actualmente en el desarrollo sostenible, la protección de sus recursos naturales y el fortalecimiento de la identidad cultural de sus pobladores.',
                'fecha_inicio' => '2000',
                'fecha_fin' => 'Presente',
                'imagen_url' => 'https://api.senefco.gob.bo/storage/historia/actualidad.jpg',
                'orden' => 4,
                'activo' => true,
                'created_at' => now(),
            ],
        ]);
    }
}
