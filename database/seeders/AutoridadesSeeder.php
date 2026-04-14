<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AutoridadesSeeder extends Seeder
{
    public function run(): void
    {
        $autoridades = [
            [
                'secretaria_id' => null,
                'nombre' => 'Carlos Alberto',
                'apellido' => 'Mamani Quispe',
                'cargo' => 'Alcalde Municipal',
                'tipo' => 'alcalde',
                'perfil_profesional' => 'Ingeniero Civil con Maestría en Gestión Pública. Más de 15 años de experiencia en administración pública y gestión de proyectos de infraestructura municipal.',
                'email_institucional' => 'alcalde@senefco.gob.bo',
                'foto_url' => null,
                'orden' => 1,
                'activo' => true,
                'fecha_inicio_cargo' => '2021-05-03',
                'fecha_fin_cargo' => null,
            ],
            [
                'secretaria_id' => null,
                'nombre' => 'María Elena',
                'apellido' => 'Flores Condori',
                'cargo' => 'Subalcalde Ejecutivo',
                'tipo' => 'subalcalde',
                'perfil_profesional' => 'Licenciada en Ciencias Políticas. Especialista en políticas públicas y desarrollo local con 10 años de trayectoria en el sector público.',
                'email_institucional' => 'subalcalde@senefco.gob.bo',
                'foto_url' => null,
                'orden' => 2,
                'activo' => true,
                'fecha_inicio_cargo' => '2021-05-03',
                'fecha_fin_cargo' => null,
            ],

            [
                'secretaria_id' => 1,
                'nombre' => 'Roberto',
                'apellido' => 'Vargas Mendoza',
                'cargo' => 'Secretario Municipal',
                'tipo' => 'secretario',
                'perfil_profesional' => 'Abogado con especialización en Derecho Administrativo. Amplia experiencia en gestión documental y coordinación institucional.',
                'email_institucional' => 'secretario.municipal@senefco.gob.bo',
                'foto_url' => null,
                'orden' => 3,
                'activo' => true,
                'fecha_inicio_cargo' => '2022-01-10',
                'fecha_fin_cargo' => null,
            ],
            [
                'secretaria_id' => 2,
                'nombre' => 'Patricia',
                'apellido' => 'Chávez Rojas',
                'cargo' => 'Secretaria de Hacienda y Finanzas',
                'tipo' => 'secretario',
                'perfil_profesional' => 'Economista con Maestría en Finanzas Públicas. Experta en administración presupuestaria y gestión financiera municipal.',
                'email_institucional' => 'secretaria.hacienda@senefco.gob.bo',
                'foto_url' => null,
                'orden' => 4,
                'activo' => true,
                'fecha_inicio_cargo' => '2022-01-10',
                'fecha_fin_cargo' => null,
            ],
            [
                'secretaria_id' => 3,
                'nombre' => 'Ing. Jorge Luis',
                'apellido' => 'Torrez Aguilar',
                'cargo' => 'Secretario de Obras Públicas e Infraestructura',
                'tipo' => 'secretario',
                'perfil_profesional' => 'Ingeniero Civil con Doctorado en Ingeniería de Transportes. Responsable de la planificación y supervisión de obras de infraestructura del municipio.',
                'email_institucional' => 'secretario.obras@senefco.gob.bo',
                'foto_url' => null,
                'orden' => 5,
                'activo' => true,
                'fecha_inicio_cargo' => '2022-03-15',
                'fecha_fin_cargo' => null,
            ],

            [
                'secretaria_id' => 4,
                'nombre' => 'Dra. Ana Sofía',
                'apellido' => 'Gutierrez Vela',
                'cargo' => 'Secretaria de Desarrollo Humano y Social',
                'tipo' => 'secretario',
                'perfil_profesional' => 'Médica con Maestría en Salud Pública. Especialista en políticas sociales y programas de atención a grupos vulnerables.',
                'email_institucional' => 'secretaria.social@senefco.gob.bo',
                'foto_url' => null,
                'orden' => 6,
                'activo' => true,
                'fecha_inicio_cargo' => '2022-01-10',
                'fecha_fin_cargo' => null,
            ],

            [
                'secretaria_id' => 5,
                'nombre' => 'Lic. Fernando',
                'apellido' => 'Calle Mamani',
                'cargo' => 'Secretario de Medio Ambiente y Gestión de Riesgos',
                'tipo' => 'secretario',
                'perfil_profesional' => 'Biólogo con Maestría en Gestión Ambiental. Especialista en manejo de residuos sólidos y gestión de riesgos naturales.',
                'email_institucional' => 'secretario.medioambiente@senefco.gob.bo',
                'foto_url' => null,
                'orden' => 7,
                'activo' => true,
                'fecha_inicio_cargo' => '2022-06-01',
                'fecha_fin_cargo' => null,
            ],

            [
                'secretaria_id' => 6,
                'nombre' => 'Msc. Claudia',
                'apellido' => 'Ponce Herrera',
                'cargo' => 'Secretaria de Planificación y Desarrollo Económico',
                'tipo' => 'secretario',
                'perfil_profesional' => 'Economista con Maestría en Planificación del Desarrollo. Experta en formulación de planes de desarrollo municipal y gestión de inversión pública.',
                'email_institucional' => 'secretaria.planificacion@senefco.gob.bo',
                'foto_url' => null,
                'orden' => 8,
                'activo' => true,
                'fecha_inicio_cargo' => '2022-01-10',
                'fecha_fin_cargo' => null,
            ],

            [
                'secretaria_id' => 7,
                'nombre' => 'Dr. Miguel Ángel',
                'apellido' => 'Salinas Ibáñez',
                'cargo' => 'Secretario Jurídico y Legal',
                'tipo' => 'secretario',
                'perfil_profesional' => 'Abogado con Doctorado en Derecho Público. Especialista en derecho municipal, contrataciones estatales y procesos administrativos.',
                'email_institucional' => 'secretario.juridico@senefco.gob.bo',
                'foto_url' => null,
                'orden' => 9,
                'activo' => true,
                'fecha_inicio_cargo' => '2021-08-01',
                'fecha_fin_cargo' => null,
            ],

            [
                'secretaria_id' => 8,
                'nombre' => 'Lic. Verónica',
                'apellido' => 'Ramos Ticona',
                'cargo' => 'Secretaria de Cultura, Turismo y Deportes',
                'tipo' => 'secretario',
                'perfil_profesional' => 'Licenciada en Comunicación Social con Maestría en Gestión Cultural. Promotora del patrimonio cultural y el turismo comunitario.',
                'email_institucional' => 'secretaria.cultura@senefco.gob.bo',
                'foto_url' => null,
                'orden' => 10,
                'activo' => true,
                'fecha_inicio_cargo' => '2022-04-01',
                'fecha_fin_cargo' => null,
            ],
        ];

        foreach ($autoridades as $data) {
            $data['slug'] = Str::slug($data['nombre'].' '.$data['apellido']);
            DB::table('autoridades')->insert($data);
        }
    }
}
