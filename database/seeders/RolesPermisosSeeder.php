<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesPermisosSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nombre' => 'Admin',                    'descripcion' => 'Acceso total al sistema',                          'activo' => true],
            ['nombre' => 'Editor de Noticias',       'descripcion' => 'Crea y publica noticias y comunicados',            'activo' => true],
            ['nombre' => 'Editor de Trámites',       'descripcion' => 'Gestiona el catálogo de trámites',                 'activo' => true],
            ['nombre' => 'Editor de Normativa',      'descripcion' => 'Publica y actualiza normas municipales',           'activo' => true],
            ['nombre' => 'Editor de Transparencia',  'descripcion' => 'Sube documentos de transparencia',                 'activo' => true],
            ['nombre' => 'Visor',                    'descripcion' => 'Solo lectura en el panel administrativo',          'activo' => true],
            ['nombre' => 'Ciudadano',                'descripcion' => 'Usuario registrado del portal público',            'activo' => true],
        ];

        DB::table('roles')->insert($roles);

        $modulos = [
            'noticias' => ['ver', 'crear', 'editar', 'eliminar', 'publicar'],
            'comunicados' => ['ver', 'crear', 'editar', 'eliminar', 'publicar'],
            'tramites' => ['ver', 'crear', 'editar', 'eliminar'],
            'normativa' => ['ver', 'crear', 'editar', 'eliminar'],
            'transparencia' => ['ver', 'crear', 'editar', 'eliminar'],
            'eventos' => ['ver', 'crear', 'editar', 'eliminar'],
            'usuarios' => ['ver', 'crear', 'editar', 'eliminar', 'asignar_roles'],
            'configuracion' => ['ver', 'editar', 'eliminar'],
            'poa' => ['ver', 'crear', 'editar', 'eliminar'],
            'presupuesto' => ['ver', 'crear', 'editar', 'eliminar'],
            'rrhh' => ['ver', 'crear', 'editar', 'eliminar'],
            'auditorias' => ['ver', 'crear', 'editar', 'eliminar'],
            'participacion' => ['ver', 'gestionar', 'eliminar'],
            'institucional' => ['ver', 'editar', 'eliminar'],
            'decretos' => ['ver', 'crear', 'editar', 'eliminar'],
            'informes-auditoria' => ['ver', 'crear', 'editar', 'eliminar'],
            'contacto' => ['ver', 'editar', 'eliminar'],
        ];

        $permisos = [];
        foreach ($modulos as $modulo => $acciones) {
            foreach ($acciones as $accion) {
                $permisos[] = [
                    'codigo' => "{$modulo}.{$accion}",
                    'descripcion' => ucfirst($accion).' '.$modulo,
                    'modulo' => $modulo,
                ];
            }
        }

        DB::table('permisos')->insert($permisos);

        $adminRolId = DB::table('roles')->where('nombre', 'Admin')->value('id');
        $todosPermisos = DB::table('permisos')->pluck('id');

        $asignaciones = $todosPermisos->map(fn ($pid) => [
            'rol_id' => $adminRolId,
            'permiso_id' => $pid,
        ])->all();

        DB::table('roles_permisos')->insert($asignaciones);

        $editorNoticiasId = DB::table('roles')->where('nombre', 'Editor de Noticias')->value('id');
        $permisosNoticias = DB::table('permisos')
            ->whereIn('modulo', ['noticias', 'comunicados', 'eventos'])
            ->pluck('id');

        DB::table('roles_permisos')->insert(
            $permisosNoticias->map(fn ($pid) => ['rol_id' => $editorNoticiasId, 'permiso_id' => $pid])->all()
        );

        $editorTramitesId = DB::table('roles')->where('nombre', 'Editor de Trámites')->value('id');
        $permisosTramites = DB::table('permisos')
            ->where('modulo', 'tramites')
            ->pluck('id');

        DB::table('roles_permisos')->insert(
            $permisosTramites->map(fn ($pid) => ['rol_id' => $editorTramitesId, 'permiso_id' => $pid])->all()
        );

        $editorNormativaId = DB::table('roles')->where('nombre', 'Editor de Normativa')->value('id');
        $permisosNormativa = DB::table('permisos')
            ->where('modulo', 'normativa')
            ->pluck('id');

        DB::table('roles_permisos')->insert(
            $permisosNormativa->map(fn ($pid) => ['rol_id' => $editorNormativaId, 'permiso_id' => $pid])->all()
        );

        $editorTranspId = DB::table('roles')->where('nombre', 'Editor de Transparencia')->value('id');
        $permisosTransp = DB::table('permisos')
            ->where('modulo', 'transparencia')
            ->pluck('id');

        DB::table('roles_permisos')->insert(
            $permisosTransp->map(fn ($pid) => ['rol_id' => $editorTranspId, 'permiso_id' => $pid])->all()
        );

        $visorId = DB::table('roles')->where('nombre', 'Visor')->value('id');
        $permisosVisor = DB::table('permisos')
            ->where('codigo', 'like', '%.ver')
            ->pluck('id');

        DB::table('roles_permisos')->insert(
            $permisosVisor->map(fn ($pid) => ['rol_id' => $visorId, 'permiso_id' => $pid])->all()
        );
    }
}
