<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebConfiguracionSitioSeeder extends Seeder
{
    public function run(): void
    {
        $config = [
            ['clave' => 'nombre_sitio',          'valor' => 'cenefco',                                    'tipo' => 'text',    'grupo' => 'identidad',  'etiqueta' => 'Nombre del sitio',           'es_publica' => true],
            ['clave' => 'nombre_institucion',    'valor' => 'cenefco',                                    'tipo' => 'text',    'grupo' => 'identidad',  'etiqueta' => 'Nombre de la institución',   'es_publica' => true],
            ['clave' => 'slogan',                'valor' => '',                                           'tipo' => 'text',    'grupo' => 'identidad',  'etiqueta' => 'Slogan',                     'es_publica' => true],
            ['clave' => 'descripcion_corta',     'valor' => '',                                           'tipo' => 'textarea', 'grupo' => 'identidad',  'etiqueta' => 'Descripción corta',          'es_publica' => true],
            ['clave' => 'logo_url',              'valor' => '',                                           'tipo' => 'image',   'grupo' => 'identidad',  'etiqueta' => 'Logo principal',             'es_publica' => true],
            ['clave' => 'logo_blanco_url',       'valor' => '',                                           'tipo' => 'image',   'grupo' => 'identidad',  'etiqueta' => 'Logo versión blanca',        'es_publica' => true],
            ['clave' => 'favicon_url',           'valor' => '',                                           'tipo' => 'image',   'grupo' => 'identidad',  'etiqueta' => 'Favicon',                    'es_publica' => true],

            ['clave' => 'email_contacto',        'valor' => '',                                           'tipo' => 'email',   'grupo' => 'contacto',   'etiqueta' => 'Email de contacto',          'es_publica' => true],
            ['clave' => 'email_institucional',   'valor' => '',                                           'tipo' => 'email',   'grupo' => 'contacto',   'etiqueta' => 'Email institucional',        'es_publica' => true],
            ['clave' => 'telefono_principal',    'valor' => '',                                           'tipo' => 'text',    'grupo' => 'contacto',   'etiqueta' => 'Teléfono principal',         'es_publica' => true],
            ['clave' => 'whatsapp_numero',       'valor' => '',                                           'tipo' => 'text',    'grupo' => 'contacto',   'etiqueta' => 'Número WhatsApp (con código país)', 'es_publica' => true],
            ['clave' => 'whatsapp_mensaje',      'valor' => 'Hola, me gustaría recibir más información.', 'tipo' => 'text',    'grupo' => 'contacto',   'etiqueta' => 'Mensaje predeterminado WA',  'es_publica' => true],
            ['clave' => 'direccion',             'valor' => '',                                           'tipo' => 'text',    'grupo' => 'contacto',   'etiqueta' => 'Dirección física',           'es_publica' => true],
            ['clave' => 'ciudad',                'valor' => '',                                           'tipo' => 'text',    'grupo' => 'contacto',   'etiqueta' => 'Ciudad',                     'es_publica' => true],
            ['clave' => 'pais',                  'valor' => 'Bolivia',                                   'tipo' => 'text',    'grupo' => 'contacto',   'etiqueta' => 'País',                       'es_publica' => true],
            ['clave' => 'mapa_embed_url',        'valor' => '',                                           'tipo' => 'text',    'grupo' => 'contacto',   'etiqueta' => 'URL embed Google Maps',      'es_publica' => true],
            ['clave' => 'horario_atencion',      'valor' => 'Lunes a viernes de 08:00 a 18:00',          'tipo' => 'text',    'grupo' => 'contacto',   'etiqueta' => 'Horario de atención',        'es_publica' => true],

            ['clave' => 'meta_titulo_default',   'valor' => 'cenefco',                                   'tipo' => 'text',    'grupo' => 'seo',        'etiqueta' => 'Meta título por defecto',    'es_publica' => false],
            ['clave' => 'meta_descripcion_default', 'valor' => '',                                         'tipo' => 'textarea', 'grupo' => 'seo',        'etiqueta' => 'Meta descripción por defecto', 'es_publica' => false],
            ['clave' => 'og_imagen_url',         'valor' => '',                                           'tipo' => 'image',   'grupo' => 'seo',        'etiqueta' => 'Imagen Open Graph por defecto', 'es_publica' => false],
            ['clave' => 'google_analytics_id',   'valor' => '',                                           'tipo' => 'text',    'grupo' => 'seo',        'etiqueta' => 'Google Analytics ID (GA4)',  'es_publica' => false],
            ['clave' => 'google_tag_manager_id', 'valor' => '',                                           'tipo' => 'text',    'grupo' => 'seo',        'etiqueta' => 'Google Tag Manager ID',      'es_publica' => false],
            ['clave' => 'facebook_pixel_id',     'valor' => '',                                           'tipo' => 'text',    'grupo' => 'seo',        'etiqueta' => 'Facebook Pixel ID',          'es_publica' => false],

            ['clave' => 'inscripcion_activa',    'valor' => '1',                                          'tipo' => 'boolean', 'grupo' => 'inscripciones', 'etiqueta' => 'Inscripciones activas',    'es_publica' => true],
            ['clave' => 'email_notif_inscripcion', 'valor' => '',                                          'tipo' => 'email',   'grupo' => 'inscripciones', 'etiqueta' => 'Email de notificación de inscripciones', 'es_publica' => false],
            ['clave' => 'dir_archivos_inscripcion', 'valor' => 'storage/inscripciones',                   'tipo' => 'text',    'grupo' => 'inscripciones', 'etiqueta' => 'Directorio archivos de inscripción', 'es_publica' => false],

            ['clave' => 'color_primario',        'valor' => '#1a56db',                                   'tipo' => 'color',   'grupo' => 'apariencia', 'etiqueta' => 'Color primario',             'es_publica' => true],
            ['clave' => 'color_secundario',      'valor' => '#e3a008',                                   'tipo' => 'color',   'grupo' => 'apariencia', 'etiqueta' => 'Color secundario',           'es_publica' => true],
            ['clave' => 'color_acento',          'valor' => '#0e9f6e',                                   'tipo' => 'color',   'grupo' => 'apariencia', 'etiqueta' => 'Color de acento',            'es_publica' => true],
            ['clave' => 'footer_texto_copyright', 'valor' => '© 2025 cenefco. Todos los derechos reservados.', 'tipo' => 'text', 'grupo' => 'apariencia', 'etiqueta' => 'Texto copyright footer',   'es_publica' => true],
        ];

        foreach ($config as $item) {
            DB::table('web_configuracion_sitio')->updateOrInsert(
                ['clave' => $item['clave']],
                $item
            );
        }
    }
}
