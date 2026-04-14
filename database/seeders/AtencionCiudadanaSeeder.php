<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtencionCiudadanaSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [

            // ── CONSULTAS ─────────────────────────────────────────────────────
            [
                'ciudadano_nombre'    => 'María Elena Quispe Mamani',
                'ciudadano_ci'        => '5821034',
                'ciudadano_email'     => 'mquispe@gmail.com',
                'ciudadano_telefono'  => '79801234',
                'tipo'                => 'consulta',
                'asunto'              => '¿Cuáles son los requisitos para obtener el certificado de domicilio?',
                'descripcion'         => 'Necesito saber qué documentos debo presentar y cuánto tiempo tarda el trámite para obtener el certificado de domicilio. Lo necesito para un trámite bancario.',
                'estado'              => 'respondido',
                'respuesta'           => "Para obtener el certificado de domicilio necesita: CI original y fotocopia, factura de luz o agua a su nombre. El plazo de entrega es 3 días hábiles. El costo es Bs. 30. Diríjase a la ventanilla de Gestión Documental en planta baja del Palacio Municipal, de lunes a viernes de 8:00 a 16:00.",
                'respondido_por'      => 'Lic. Carmen Flores - Gestión Documental',
                'respondido_at'       => now()->subDays(5)->subHours(2),
                'created_at'          => now()->subDays(6),
            ],
            [
                'ciudadano_nombre'    => 'Roberto Mamani Callisaya',
                'ciudadano_ci'        => '9012345',
                'ciudadano_email'     => null,
                'ciudadano_telefono'  => '73219876',
                'tipo'                => 'consulta',
                'asunto'              => '¿Cuándo se inicia la pavimentación de la Calle 5 de la Urbanización Villa Esperanza?',
                'descripcion'         => 'Los vecinos de la Urbanización Villa Esperanza llevamos años esperando la pavimentación de la Calle 5. Quisiéramos saber si está contemplada en el POA 2026 y cuándo comenzaría.',
                'estado'              => 'en_proceso',
                'respuesta'           => null,
                'respondido_por'      => null,
                'respondido_at'       => null,
                'created_at'          => now()->subDays(3),
            ],
            [
                'ciudadano_nombre'    => 'Ana Beatriz Quispe López',
                'ciudadano_ci'        => '2345678',
                'ciudadano_email'     => 'aquispe@hotmail.com',
                'ciudadano_telefono'  => '75432198',
                'tipo'                => 'consulta',
                'asunto'              => '¿El municipio tiene algún programa de apoyo para adultos mayores?',
                'descripcion'         => 'Soy hija de un adulto mayor de 78 años que vive solo. Quisiera saber si la Alcaldía cuenta con programas de asistencia, visitas domiciliarias o apoyo social para personas de la tercera edad.',
                'estado'              => 'pendiente',
                'respuesta'           => null,
                'respondido_por'      => null,
                'respondido_at'       => null,
                'created_at'          => now()->subDay(),
            ],

            // ── QUEJAS ────────────────────────────────────────────────────────
            [
                'ciudadano_nombre'    => 'Juan Carlos Flores Ticona',
                'ciudadano_ci'        => '7234591',
                'ciudadano_email'     => 'jflores@gmail.com',
                'ciudadano_telefono'  => '76543210',
                'tipo'                => 'queja',
                'asunto'              => 'Basura acumulada por más de una semana en Av. Principal esq. Calle 3',
                'descripcion'         => 'En la intersección de la Av. Principal con la Calle 3 de nuestra urbanización se acumula basura desde hace más de 7 días. El camión recolector no ha pasado y el olor es insoportable. Hay riesgo de proliferación de vectores.',
                'estado'              => 'respondido',
                'respuesta'           => 'Se ha coordinado con la Unidad de Residuos Sólidos para realizar la limpieza del punto indicado. El servicio fue ejecutado el 07/04/2026. Se reforzará la ruta de recolección con frecuencia semanal en esa zona.',
                'respondido_por'      => 'Ing. Pedro Condori - Residuos Sólidos',
                'respondido_at'       => now()->subDays(2),
                'created_at'          => now()->subDays(8),
            ],
            [
                'ciudadano_nombre'    => 'Rosa Condori de Huanca',
                'ciudadano_ci'        => '4512367',
                'ciudadano_email'     => null,
                'ciudadano_telefono'  => '72109876',
                'tipo'                => 'queja',
                'asunto'              => 'Luminarias apagadas hace 3 semanas en pasaje Illimani',
                'descripcion'         => 'El pasaje Illimani lleva más de 20 días sin alumbrado público. Esto genera inseguridad, especialmente para las mujeres que regresan del trabajo en la noche. Solicito atención urgente.',
                'estado'              => 'en_proceso',
                'respuesta'           => null,
                'respondido_por'      => null,
                'respondido_at'       => null,
                'created_at'          => now()->subDays(4),
            ],
            [
                'ciudadano_nombre'    => 'Luis Alberto Chura Poma',
                'ciudadano_ci'        => '8901234',
                'ciudadano_email'     => 'lchura@yahoo.com',
                'ciudadano_telefono'  => '77654321',
                'tipo'                => 'queja',
                'asunto'              => 'Ruido excesivo de taller mecánico en zona residencial',
                'descripcion'         => 'Existe un taller mecánico en la calle Bolívar 234 que opera desde las 6 de la mañana hasta las 10 de la noche con ruidos de esmerilado y golpes que afectan el descanso de los vecinos. Solicito inspección y sanción.',
                'estado'              => 'pendiente',
                'respuesta'           => null,
                'respondido_por'      => null,
                'respondido_at'       => null,
                'created_at'          => now()->subHours(18),
            ],

            // ── SUGERENCIAS ───────────────────────────────────────────────────
            [
                'ciudadano_nombre'    => 'Carmen Llanos Vargas',
                'ciudadano_ci'        => '3456789',
                'ciudadano_email'     => 'cllanos@gmail.com',
                'ciudadano_telefono'  => '71234567',
                'tipo'                => 'sugerencia',
                'asunto'              => 'Instalación de tachos de reciclaje en el parque central',
                'descripcion'         => 'Sugiero que la Alcaldía instale tachos diferenciados para reciclaje (plástico, papel, orgánico) en el parque central. Muchos vecinos ya tenemos cultura de reciclaje pero no contamos con los contenedores apropiados.',
                'estado'              => 'respondido',
                'respuesta'           => 'Gracias por su sugerencia. Ha sido remitida a la Unidad de Medio Ambiente para su evaluación e inclusión en el plan de gestión ambiental 2026-2027. Se priorizará en la próxima fase del Programa Municipal de Reciclaje.',
                'respondido_por'      => 'Lic. Sonia Mamani - Medio Ambiente',
                'respondido_at'       => now()->subDays(10),
                'created_at'          => now()->subDays(15),
            ],
            [
                'ciudadano_nombre'    => 'Pedro Mamani Apaza',
                'ciudadano_ci'        => '6789023',
                'ciudadano_email'     => null,
                'ciudadano_telefono'  => '78765432',
                'tipo'                => 'sugerencia',
                'asunto'              => 'Habilitación de un espacio para ferias artesanales los fines de semana',
                'descripcion'         => 'Propongo habilitar la plaza principal los sábados y domingos para una feria artesanal permanente donde los productores locales podamos vender nuestros productos. Generaría empleo y turismo local.',
                'estado'              => 'pendiente',
                'respuesta'           => null,
                'respondido_por'      => null,
                'respondido_at'       => null,
                'created_at'          => now()->subDays(2),
            ],

            // ── DENUNCIAS ─────────────────────────────────────────────────────
            [
                'ciudadano_nombre'    => 'Anónimo',
                'ciudadano_ci'        => null,
                'ciudadano_email'     => null,
                'ciudadano_telefono'  => null,
                'tipo'                => 'denuncia',
                'asunto'              => 'Construcción sin permiso municipal en calle Arce 456',
                'descripcion'         => 'En la calle Arce 456 se está levantando una construcción de 3 pisos sin contar con permiso municipal visible. Los trabajos comenzaron hace 2 meses. La construcción ocupa parte de la acera.',
                'estado'              => 'en_proceso',
                'respuesta'           => null,
                'respondido_por'      => null,
                'respondido_at'       => null,
                'created_at'          => now()->subDays(5),
            ],
            [
                'ciudadano_nombre'    => 'Vecinos Urbanización Los Pinos',
                'ciudadano_ci'        => null,
                'ciudadano_email'     => 'veclospinos@gmail.com',
                'ciudadano_telefono'  => '72000111',
                'tipo'                => 'denuncia',
                'asunto'              => 'Vertido ilegal de residuos industriales en río Kajahuanuni',
                'descripcion'         => 'Una empresa constructora está descargando escombros y residuos directamente en el río Kajahuanuni a la altura del puente Los Pinos. El lecho del río está siendo dañado y el agua se contamina. Adjuntamos fotografías.',
                'estado'              => 'respondido',
                'respuesta'           => 'Se realizó inspección el 06/04/2026 y se constató el vertido ilegal. Se notificó a la empresa con orden de limpieza inmediata y se inició proceso administrativo sancionatorio. Se coordinará seguimiento con la Gobernación.',
                'respondido_por'      => 'Ing. Carlos Ticona - Medio Ambiente',
                'respondido_at'       => now()->subDays(3),
                'created_at'          => now()->subDays(7),
            ],

            // ── SOLICITUDES ───────────────────────────────────────────────────
            [
                'ciudadano_nombre'    => 'Junta Vecinal Villa Hermosa',
                'ciudadano_ci'        => null,
                'ciudadano_email'     => 'jvvillahermosa@gmail.com',
                'ciudadano_telefono'  => '78123456',
                'tipo'                => 'solicitud',
                'asunto'              => 'Solicitud de apertura de calle entre Av. Ecológica y Calle Nueva',
                'descripcion'         => 'La Junta Vecinal de Villa Hermosa solicita formalmente la apertura y encarpetado de la calle que conecta la Av. Ecológica con la nueva urbanización. Es la única vía de acceso para más de 80 familias.',
                'estado'              => 'en_proceso',
                'respuesta'           => null,
                'respondido_por'      => null,
                'respondido_at'       => null,
                'created_at'          => now()->subDays(10),
            ],
            [
                'ciudadano_nombre'    => 'Ernesto Vargas Apaza',
                'ciudadano_ci'        => '1234567',
                'ciudadano_email'     => 'evargas@outlook.com',
                'ciudadano_telefono'  => '76001234',
                'tipo'                => 'solicitud',
                'asunto'              => 'Solicitud de inspección y limpieza de canal de riego sector Chilloca',
                'descripcion'         => 'Los agricultores del sector Chilloca solicitamos inspección técnica y limpieza del canal de riego principal que está obstruido con sedimentos. Afecta el riego de más de 15 hectáreas de cultivos.',
                'estado'              => 'cerrado',
                'respuesta'           => 'La inspección se realizó el 02/04/2026. Se ejecutó la limpieza del canal el 04/04/2026 con maquinaria de la Alcaldía. El canal está operativo. Se programa mantenimiento semestral.',
                'respondido_por'      => 'Téc. Mario Huanca - Proyectos e Ingeniería',
                'respondido_at'       => now()->subDays(5),
                'created_at'          => now()->subDays(12),
            ],
            [
                'ciudadano_nombre'    => 'Gabriela Torres Mendoza',
                'ciudadano_ci'        => '5678901',
                'ciudadano_email'     => 'gtorres@gmail.com',
                'ciudadano_telefono'  => '79111222',
                'tipo'                => 'solicitud',
                'asunto'              => 'Solicitud de instalación de reductor de velocidad en Av. Los Álamos',
                'descripcion'         => 'Los vecinos de la Av. Los Álamos solicitamos la instalación de un reductor de velocidad (badén) frente a la Unidad Educativa Los Álamos. Los vehículos transitan a alta velocidad poniendo en riesgo a los escolares.',
                'estado'              => 'pendiente',
                'respuesta'           => null,
                'respondido_por'      => null,
                'respondido_at'       => null,
                'created_at'          => now()->subHours(6),
            ],
        ];

        foreach ($registros as $reg) {
            DB::table('atencion_ciudadana')->insert(array_merge($reg, [
                'updated_at' => $reg['respondido_at'] ?? $reg['created_at'],
            ]));
        }

        $this->command->info('✅ ' . count($registros) . ' registros de atención ciudadana creados.');
    }
}
