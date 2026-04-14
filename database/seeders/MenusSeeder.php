<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\DisablesForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusSeeder extends Seeder
{
    use DisablesForeignKeys;

    public function run(): void
    {
        $this->disableForeignKeys();
        DB::table('menu_items')->truncate();
        DB::table('menus')->truncate();
        $this->enableForeignKeys();

        $menuPrincipalId = DB::table('menus')->insertGetId([
            'nombre' => 'menu_principal',
            'descripcion' => 'Menú de navegación principal del portal',
            'activo' => true,
        ]);

        $menuFooterId = DB::table('menus')->insertGetId([
            'nombre' => 'footer',
            'descripcion' => 'Menú del pie de página',
            'activo' => true,
        ]);

        DB::table('menus')->insert([
            'nombre' => 'accesos_rapidos',
            'descripcion' => 'Accesos rápidos del home',
            'activo' => true,
        ]);

        DB::table('menu_items')->insert([
            ['menu_id' => $menuPrincipalId, 'parent_id' => null, 'etiqueta' => 'Inicio',          'url' => '/home-1', 'orden' => 1, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => null, 'etiqueta' => 'Institucional',    'url' => null,      'orden' => 2, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => null, 'etiqueta' => 'Noticias',         'url' => null,      'orden' => 3, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => null, 'etiqueta' => 'Trámites',        'url' => null,      'orden' => 4, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => null, 'etiqueta' => 'Normativa',        'url' => null,      'orden' => 5, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => null, 'etiqueta' => 'Transparencia',    'url' => null,      'orden' => 6, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => null, 'etiqueta' => 'Participación',   'url' => null,      'orden' => 7, 'activo' => true],
        ]);

        $getId = fn (string $etiqueta) => DB::table('menu_items')
            ->where('menu_id', $menuPrincipalId)
            ->where('etiqueta', $etiqueta)
            ->value('id');

        $institucionalId = $getId('Institucional');
        DB::table('menu_items')->insert([
            ['menu_id' => $menuPrincipalId, 'parent_id' => $institucionalId, 'etiqueta' => 'Historia',         'url' => '/institucional/historia',    'orden' => 1, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $institucionalId, 'etiqueta' => 'Autoridades',      'url' => '/institucional/autoridades', 'orden' => 2, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $institucionalId, 'etiqueta' => 'Subalcaldías',    'url' => '/subsenefcos',              'orden' => 4, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $institucionalId, 'etiqueta' => 'Organigrama',     'url' => '/institucional/organigrama', 'orden' => 5, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $institucionalId, 'etiqueta' => 'Plan de Gobierno', 'url' => '/institucional/plan-gobierno', 'orden' => 6, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $institucionalId, 'etiqueta' => 'Himno',           'url' => '/institucional/himno',       'orden' => 7, 'activo' => true],
        ]);

        $noticiasId = $getId('Noticias');
        DB::table('menu_items')->insert([
            ['menu_id' => $menuPrincipalId, 'parent_id' => $noticiasId, 'etiqueta' => 'Todas las noticias', 'url' => '/noticias',             'orden' => 1, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $noticiasId, 'etiqueta' => 'Comunicados',        'url' => '/comunicados',          'orden' => 2, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $noticiasId, 'etiqueta' => 'Eventos',            'url' => '/eventos',              'orden' => 3, 'activo' => true],
        ]);

        $tramitesId = $getId('Trámites');
        DB::table('menu_items')->insert([
            ['menu_id' => $menuPrincipalId, 'parent_id' => $tramitesId, 'etiqueta' => 'Catálogo de trámites', 'url' => '/tramites',                 'orden' => 1, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $tramitesId, 'etiqueta' => 'Trámites en línea',    'url' => '/tramites/en-linea',        'orden' => 2, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $tramitesId, 'etiqueta' => 'Requisitos',           'url' => '/tramites/requisitos',      'orden' => 3, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $tramitesId, 'etiqueta' => 'Estado de trámite',   'url' => '/tramites/estado',          'orden' => 4, 'activo' => true],
        ]);

        $normativaId = $getId('Normativa');
        DB::table('menu_items')->insert([
            ['menu_id' => $menuPrincipalId, 'parent_id' => $normativaId, 'etiqueta' => 'Leyes',            'url' => '/normativa?tipo=ley',          'orden' => 1, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $normativaId, 'etiqueta' => 'Decretos',         'url' => '/normativa?tipo=decreto',      'orden' => 2, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $normativaId, 'etiqueta' => 'Resoluciones',     'url' => '/normativa?tipo=resolucion',   'orden' => 3, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $normativaId, 'etiqueta' => 'Ordenanzas',       'url' => '/normativa?tipo=ordenanza',    'orden' => 4, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $normativaId, 'etiqueta' => 'Toda la normativa', 'url' => '/normativa',                   'orden' => 5, 'activo' => true],
        ]);

        $transparenciaId = $getId('Transparencia');
        DB::table('menu_items')->insert([
            ['menu_id' => $menuPrincipalId, 'parent_id' => $transparenciaId, 'etiqueta' => 'Documentos',         'url' => '/transparencia/documentos',  'orden' => 1, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $transparenciaId, 'etiqueta' => 'POA',                'url' => '/transparencia/poa',         'orden' => 2, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $transparenciaId, 'etiqueta' => 'Presupuesto',        'url' => '/transparencia/presupuesto', 'orden' => 3, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $transparenciaId, 'etiqueta' => 'Auditorías',        'url' => '/transparencia/auditorias',  'orden' => 4, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $transparenciaId, 'etiqueta' => 'Nómina de Personal', 'url' => '/transparencia/rrhh',        'orden' => 5, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $transparenciaId, 'etiqueta' => 'Manuales',          'url' => '/transparencia/manuales',    'orden' => 6, 'activo' => true],
        ]);

        $participacionId = $getId('Participación');
        DB::table('menu_items')->insert([
            ['menu_id' => $menuPrincipalId, 'parent_id' => $participacionId, 'etiqueta' => 'Consultas ciudadanas', 'url' => '/participacion/consultas',   'orden' => 1, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $participacionId, 'etiqueta' => 'Sugerencias y quejas', 'url' => '/participacion/sugerencias', 'orden' => 2, 'activo' => true],
            ['menu_id' => $menuPrincipalId, 'parent_id' => $participacionId, 'etiqueta' => 'Audiencias públicas',  'url' => '/audiencias-publicas',       'orden' => 3, 'activo' => true],
        ]);

        DB::table('menu_items')->insert([
            ['menu_id' => $menuFooterId, 'parent_id' => null, 'etiqueta' => 'Inicio',              'url' => '/home-1',                    'orden' => 1,  'activo' => true],
            ['menu_id' => $menuFooterId, 'parent_id' => null, 'etiqueta' => 'Noticias',             'url' => '/noticias',                  'orden' => 2,  'activo' => true],
            ['menu_id' => $menuFooterId, 'parent_id' => null, 'etiqueta' => 'Eventos',              'url' => '/eventos',                   'orden' => 3,  'activo' => true],
            ['menu_id' => $menuFooterId, 'parent_id' => null, 'etiqueta' => 'Trámites',            'url' => '/tramites',                  'orden' => 4,  'activo' => true],
            ['menu_id' => $menuFooterId, 'parent_id' => null, 'etiqueta' => 'Normativa',            'url' => '/normativa',                 'orden' => 5,  'activo' => true],
            ['menu_id' => $menuFooterId, 'parent_id' => null, 'etiqueta' => 'Transparencia',        'url' => '/transparencia/documentos',  'orden' => 6,  'activo' => true],
            ['menu_id' => $menuFooterId, 'parent_id' => null, 'etiqueta' => 'Secretarías',         'url' => '/institucional/secretarias', 'orden' => 7,  'activo' => true],
            ['menu_id' => $menuFooterId, 'parent_id' => null, 'etiqueta' => 'Autoridades',          'url' => '/institucional/autoridades', 'orden' => 8,  'activo' => true],
            ['menu_id' => $menuFooterId, 'parent_id' => null, 'etiqueta' => 'Contacto',             'url' => '/contacto',                  'orden' => 9,  'activo' => true],
            ['menu_id' => $menuFooterId, 'parent_id' => null, 'etiqueta' => 'Política de Privacidad', 'url' => '/privacidad',               'orden' => 10, 'activo' => true],
        ]);
    }
}
