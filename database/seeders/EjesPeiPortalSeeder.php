<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EjesPeiPortalSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            [
                'nombre'      => 'Desarrollo Humano y Social Inclusivo',
                'descripcion' => "Garantizar el acceso equitativo a servicios de salud, educación, protección social y bienestar para todos los habitantes del municipio, con énfasis en grupos vulnerables: niñez, adultos mayores, personas con discapacidad y mujeres en situación de violencia.\n\nObjetivos estratégicos:\n• Ampliar la cobertura de programas de asistencia social.\n• Fortalecer el SLIM y la Defensoría de la Niñez (DNA).\n• Implementar el bono municipal para adultos mayores en situación de vulnerabilidad.\n• Promover la igualdad de género y la participación de la mujer en el desarrollo local.",
                'color'       => '#3B82F6',
                'imagen_url'  => null,
                'orden'       => 1,
                'activo'      => true,
            ],
            [
                'nombre'      => 'Infraestructura y Ordenamiento Territorial',
                'descripcion' => "Mejorar la infraestructura vial, edilicia y de servicios básicos del municipio, promoviendo un ordenamiento territorial planificado que garantice el acceso de todas las comunidades a vías pavimentadas, alumbrado público, agua potable y alcantarillado.\n\nObjetivos estratégicos:\n• Pavimentar y mantener la red vial urbana y rural del municipio.\n• Ejecutar proyectos de apertura de calles en urbanizaciones consolidadas.\n• Modernizar el catastro urbano y rural municipal.\n• Ampliar la cobertura de alumbrado público en áreas deficitarias.",
                'color'       => '#F59E0B',
                'imagen_url'  => null,
                'orden'       => 2,
                'activo'      => true,
            ],
            [
                'nombre'      => 'Gestión Ambiental y Cambio Climático',
                'descripcion' => "Proteger el medioambiente municipal, gestionar adecuadamente los residuos sólidos, conservar las áreas verdes y reducir la vulnerabilidad frente al cambio climático y los desastres naturales, promoviendo una cultura ambiental en la población.\n\nObjetivos estratégicos:\n• Implementar el Plan Municipal de Gestión Integral de Residuos Sólidos.\n• Ampliar y mantener áreas verdes, parques y espacios de recreación.\n• Fortalecer la capacidad de respuesta ante desastres y emergencias.\n• Controlar fuentes de contaminación: ruido, aire, agua y suelo.",
                'color'       => '#10B981',
                'imagen_url'  => null,
                'orden'       => 3,
                'activo'      => true,
            ],
            [
                'nombre'      => 'Desarrollo Económico Local y Productivo',
                'descripcion' => "Fomentar el desarrollo económico del municipio apoyando a productores locales, emprendedores, artesanos y pequeñas empresas, mediante programas de capacitación, ferias, acceso a mercados y fortalecimiento de la economía plural.\n\nObjetivos estratégicos:\n• Habilitar espacios para ferias productivas y artesanales permanentes.\n• Desarrollar programas de microcrédito y asistencia técnica para emprendedores.\n• Promover el turismo local y la identidad cultural del municipio.\n• Fortalecer las cadenas productivas agropecuarias del área rural.",
                'color'       => '#8B5CF6',
                'imagen_url'  => null,
                'orden'       => 4,
                'activo'      => true,
            ],
            [
                'nombre'      => 'Gobernanza, Transparencia y Participación Ciudadana',
                'descripcion' => "Fortalecer la gestión pública municipal con transparencia, ética, eficiencia y participación activa de la ciudadanía en la toma de decisiones, garantizando el acceso a la información y la rendición de cuentas permanente.\n\nObjetivos estratégicos:\n• Implementar el sistema de gestión documental y trámites en línea.\n• Realizar audiencias públicas y cabildos de rendición de cuentas.\n• Publicar el presupuesto, POA y ejecución presupuestaria en el portal institucional.\n• Fortalecer los mecanismos de control social y las juntas vecinales.",
                'color'       => '#EF4444',
                'imagen_url'  => null,
                'orden'       => 5,
                'activo'      => true,
            ],
            [
                'nombre'      => 'Cultura, Deporte y Recreación',
                'descripcion' => "Promover la identidad cultural del municipio, el deporte como herramienta de inclusión social y el acceso de la población a espacios de recreación y actividad física, fortaleciendo la cohesión comunitaria y el buen vivir.\n\nObjetivos estratégicos:\n• Construir y mantener infraestructura deportiva de calidad para todos los barrios.\n• Organizar eventos culturales, folclóricos y artísticos de alcance municipal.\n• Apoyar a clubes deportivos y asociaciones culturales locales.\n• Recuperar y difundir las tradiciones e historia del municipio.",
                'color'       => '#EC4899',
                'imagen_url'  => null,
                'orden'       => 6,
                'activo'      => true,
            ],
            [
                'nombre'      => 'Modernización Institucional y Gestión Eficiente',
                'descripcion' => "Modernizar la administración municipal mediante la adopción de tecnologías de información, el fortalecimiento de capacidades del personal, la simplificación de trámites y la mejora continua de los procesos institucionales para brindar servicios de calidad a la ciudadanía.\n\nObjetivos estratégicos:\n• Implementar sistemas informáticos para la gestión municipal integrada.\n• Capacitar y profesionalizar al personal de la Alcaldía.\n• Simplificar y digitalizar los trámites administrativos.\n• Optimizar el uso de los recursos públicos con criterios de eficiencia y eficacia.",
                'color'       => '#06B6D4',
                'imagen_url'  => null,
                'orden'       => 7,
                'activo'      => true,
            ],
        ];

        $now = now()->toDateTimeString();
        foreach ($registros as &$reg) {
            $reg['created_at'] = $now;
            $reg['updated_at'] = $now;
        }

        DB::table('ejes_pei_portal')->insert($registros);

        $this->command->info('✅ ' . count($registros) . ' ejes PEI creados.');
    }
}
