<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganigramaSeeder extends Seeder
{
    public function run(): void
    {
        $senefco = DB::table('organigrama')->insertGetId([
            'secretaria_id' => 1, // Secretaría Municipal
            'parent_id' => null,
            'nivel' => 0,
            'orden' => 1,
            'imagen_url' => null,
            'fecha_actualizacion' => '2024-01-01',
            'vigente' => true,
        ]);

        $secretarias = [
            ['secretaria_id' => 1, 'orden' => 1], // Secretaría Municipal
            ['secretaria_id' => 2, 'orden' => 2], // Hacienda y Finanzas
            ['secretaria_id' => 3, 'orden' => 3], // Obras Públicas
            ['secretaria_id' => 4, 'orden' => 4], // Desarrollo Humano
            ['secretaria_id' => 5, 'orden' => 5], // Medio Ambiente
            ['secretaria_id' => 6, 'orden' => 6], // Planificación
            ['secretaria_id' => 7, 'orden' => 7], // Jurídica
            ['secretaria_id' => 8, 'orden' => 8], // Cultura
        ];

        $nodosPorSecretaria = [];
        foreach ($secretarias as $s) {
            $id = DB::table('organigrama')->insertGetId([
                'secretaria_id' => $s['secretaria_id'],
                'parent_id' => $senefco,
                'nivel' => 1,
                'orden' => $s['orden'],
                'imagen_url' => null,
                'fecha_actualizacion' => '2024-01-01',
                'vigente' => true,
            ]);
            $nodosPorSecretaria[$s['secretaria_id']] = $id;
        }

        $unidades = DB::table('unidades_responsables')->get(['id', 'secretaria_id', 'nombre']);
        $ordenPorSecretaria = [];
        foreach ($unidades as $unidad) {
            $parentId = $nodosPorSecretaria[$unidad->secretaria_id] ?? null;
            if (! $parentId) {
                continue;
            }
            $ordenPorSecretaria[$unidad->secretaria_id] = ($ordenPorSecretaria[$unidad->secretaria_id] ?? 0) + 1;

            DB::table('organigrama')->insert([
                'secretaria_id' => $unidad->secretaria_id,
                'parent_id' => $parentId,
                'nivel' => 2,
                'orden' => $ordenPorSecretaria[$unidad->secretaria_id],
                'imagen_url' => null,
                'fecha_actualizacion' => '2024-01-01',
                'vigente' => true,
            ]);
        }
    }
}
