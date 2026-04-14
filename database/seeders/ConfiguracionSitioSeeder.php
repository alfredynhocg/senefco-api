<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracionSitioSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $config = [
            ['clave' => 'nombre_municipio',    'valor' => 'Municipio de Achocalla',       'tipo_dato' => 'string',  'descripcion' => 'Nombre oficial del municipio'],
            ['clave' => 'eslogan',             'valor' => 'Trabajando por tu bienestar',  'tipo_dato' => 'string',  'descripcion' => 'Eslogan institucional'],
            ['clave' => 'email_contacto',      'valor' => 'contacto@senefco.gob.bo',     'tipo_dato' => 'string',  'descripcion' => 'Email principal de contacto'],
            ['clave' => 'telefono_central',    'valor' => '(02) 280-0000',                'tipo_dato' => 'string',  'descripcion' => 'Teléfono de la central telefónica'],
            ['clave' => 'direccion',           'valor' => 'Plaza Principal s/n',          'tipo_dato' => 'string',  'descripcion' => 'Dirección física de la alcaldía'],
            ['clave' => 'horario_atencion',    'valor' => 'Lunes a Viernes 8:30 - 16:30', 'tipo_dato' => 'string',  'descripcion' => 'Horario de atención al público'],
            ['clave' => 'mantenimiento',       'valor' => 'false',                        'tipo_dato' => 'boolean', 'descripcion' => 'Activar modo mantenimiento del portal'],
            ['clave' => 'paginado_noticias',   'valor' => '12',                           'tipo_dato' => 'int',     'descripcion' => 'Noticias por página en el listado'],
            ['clave' => 'paginado_tramites',   'valor' => '20',                           'tipo_dato' => 'int',     'descripcion' => 'Trámites por página en el catálogo'],
            ['clave' => 'color_primario',      'valor' => '#1565C0',                      'tipo_dato' => 'string',  'descripcion' => 'Color primario del tema del portal'],
            ['clave' => 'color_secundario',    'valor' => '#E65100',                      'tipo_dato' => 'string',  'descripcion' => 'Color secundario del tema del portal'],
            ['clave' => 'logo_url',            'valor' => '/img/logo-senefco.png',       'tipo_dato' => 'string',  'descripcion' => 'URL del logo institucional'],
            ['clave' => 'favicon_url',         'valor' => '/img/favicon.ico',             'tipo_dato' => 'string',  'descripcion' => 'URL del favicon'],
            ['clave' => 'recaptcha_activo',    'valor' => 'true',                         'tipo_dato' => 'boolean', 'descripcion' => 'Activar reCAPTCHA en formularios públicos'],
        ];

        foreach ($config as &$item) {
            $item['updated_at'] = $now;
            $item['actualizado_por'] = null;
        }

        DB::table('configuracion_sitio')->insert($config);
    }
}
