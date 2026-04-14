<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SecretariasSeeder extends Seeder
{
    public function run(): void
    {
        $secretarias = [
            [
                'nombre' => 'Secretaría Municipal',
                'sigla' => 'SM',
                'atribuciones' => 'Gestión administrativa, coordinación interinstitucional, actas y resoluciones municipales.',
                'direccion_fisica' => 'Planta baja del Palacio Municipal',
                'telefono' => '+591 2 2000001',
                'email' => 'secretaria@senefco.gob.bo',
                'horario_atencion' => 'Lun-Vie 08:30–16:30',
                'foto_titular_url' => null,
                'orden_organigrama' => 1,
                'activa' => true,
            ],
            [
                'nombre' => 'Secretaría de Hacienda y Finanzas',
                'sigla' => 'SHF',
                'atribuciones' => 'Administración presupuestaria, recaudación tributaria y ejecución financiera del municipio.',
                'direccion_fisica' => 'Primer piso, ala norte del Palacio Municipal',
                'telefono' => '+591 2 2000002',
                'email' => 'hacienda@senefco.gob.bo',
                'horario_atencion' => 'Lun-Vie 08:30–16:30',
                'foto_titular_url' => null,
                'orden_organigrama' => 2,
                'activa' => true,
            ],
            [
                'nombre' => 'Secretaría de Obras Públicas e Infraestructura',
                'sigla' => 'SOPI',
                'atribuciones' => 'Planificación, ejecución y supervisión de obras públicas, mantenimiento vial y proyectos de infraestructura.',
                'direccion_fisica' => 'Segundo piso del Palacio Municipal',
                'telefono' => '+591 2 2000003',
                'email' => 'obras@senefco.gob.bo',
                'horario_atencion' => 'Lun-Vie 08:30–16:30',
                'foto_titular_url' => null,
                'orden_organigrama' => 3,
                'activa' => true,
            ],
            [
                'nombre' => 'Secretaría de Desarrollo Humano y Social',
                'sigla' => 'SDHS',
                'atribuciones' => 'Programas sociales, atención a grupos vulnerables, salud comunitaria y educación municipal.',
                'direccion_fisica' => 'Tercer piso del Palacio Municipal',
                'telefono' => '+591 2 2000004',
                'email' => 'desarrollo.social@senefco.gob.bo',
                'horario_atencion' => 'Lun-Vie 08:30–16:30',
                'foto_titular_url' => null,
                'orden_organigrama' => 4,
                'activa' => true,
            ],
            [
                'nombre' => 'Secretaría de Medio Ambiente y Gestión de Riesgos',
                'sigla' => 'SMAGR',
                'atribuciones' => 'Gestión ambiental, manejo de residuos sólidos, áreas verdes y prevención de desastres naturales.',
                'direccion_fisica' => 'Av. Ecológica 123',
                'telefono' => '+591 2 2000005',
                'email' => 'medioambiente@senefco.gob.bo',
                'horario_atencion' => 'Lun-Vie 08:30–16:30',
                'foto_titular_url' => null,
                'orden_organigrama' => 5,
                'activa' => true,
            ],
            [
                'nombre' => 'Secretaría de Planificación y Desarrollo Económico',
                'sigla' => 'SPDE',
                'atribuciones' => 'Formulación del POA, planes de desarrollo municipal, fomento productivo y gestión de proyectos de inversión.',
                'direccion_fisica' => 'Cuarto piso del Palacio Municipal',
                'telefono' => '+591 2 2000006',
                'email' => 'planificacion@senefco.gob.bo',
                'horario_atencion' => 'Lun-Vie 08:30–16:30',
                'foto_titular_url' => null,
                'orden_organigrama' => 6,
                'activa' => true,
            ],
            [
                'nombre' => 'Secretaría Jurídica y Legal',
                'sigla' => 'SJL',
                'atribuciones' => 'Asesoramiento legal, defensa jurídica institucional, contratos y procesos administrativos.',
                'direccion_fisica' => 'Primer piso, ala sur del Palacio Municipal',
                'telefono' => '+591 2 2000007',
                'email' => 'juridica@senefco.gob.bo',
                'horario_atencion' => 'Lun-Vie 08:30–16:30',
                'foto_titular_url' => null,
                'orden_organigrama' => 7,
                'activa' => true,
            ],
            [
                'nombre' => 'Secretaría de Cultura, Turismo y Deportes',
                'sigla' => 'SCTD',
                'atribuciones' => 'Promoción cultural, turismo local, actividades deportivas y gestión de espacios recreativos.',
                'direccion_fisica' => 'Centro Cultural Municipal, planta baja',
                'telefono' => '+591 2 2000008',
                'email' => 'cultura@senefco.gob.bo',
                'horario_atencion' => 'Lun-Vie 08:30–16:30',
                'foto_titular_url' => null,
                'orden_organigrama' => 8,
                'activa' => true,
            ],
        ];

        foreach ($secretarias as $data) {
            $data['slug'] = Str::slug($data['nombre']);
            DB::table('secretarias')->insert($data);
        }
    }
}
