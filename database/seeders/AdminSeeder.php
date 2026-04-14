<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $adminId = DB::table('usuarios')->insertGetId([
            'nombre' => 'Admin',
            'apellido' => 'Sistema',
            'email' => 'admin@senefco.gob.bo',
            'password_hash' => Hash::make('Admin2026!'),
            'tipo' => 'admin',
            'ci' => '00000000',
            'telefono' => null,
            'activo' => true,
            'email_verificado' => true,
            'codigo_verificacion' => null,
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null,
        ]);

        $rolAdminId = DB::table('roles')->where('nombre', 'Admin')->value('id');

        if ($rolAdminId) {
            DB::table('usuarios_roles')->insert([
                'usuario_id' => $adminId,
                'rol_id' => $rolAdminId,
                'asignado_at' => $now,
                'asignado_por' => $adminId,
            ]);
        }

        DB::table('usuarios')->insert([
            'nombre' => 'Juan',
            'apellido' => 'Ciudadano',
            'email' => 'ciudadano@ejemplo.com',
            'password_hash' => Hash::make('Ciudadano2026!'),
            'tipo' => 'ciudadano',
            'ci' => '12345678',
            'telefono' => '77000000',
            'activo' => true,
            'email_verificado' => true,
            'codigo_verificacion' => null,
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null,
        ]);
    }
}
