<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreguntasFrecuentesSeeder extends Seeder
{
    public function run(): void
    {
        $preguntas = [
            [
                'categoria' => 'Trámites',
                'pregunta' => '¿Cómo puedo obtener un certificado de residencia?',
                'respuesta' => 'Para obtener el certificado de residencia debe presentarse en la Oficialía Mayor con su carnet de identidad original y una copia, comprobante de domicilio (factura de agua, luz o gas) y llenar el formulario de solicitud. El trámite tarda entre 1 a 3 días hábiles.',
                'orden' => 1,
            ],
            [
                'categoria' => 'Trámites',
                'pregunta' => '¿Qué requisitos necesito para obtener una licencia de funcionamiento?',
                'respuesta' => 'Para obtener la licencia de funcionamiento debe presentar: fotocopia de carnet de identidad, NIT del negocio, contrato de alquiler o título de propiedad del local, plano de ubicación, formulario de solicitud llenado y cancelar los aranceles correspondientes según el tipo de negocio.',
                'orden' => 2,
            ],
            [
                'categoria' => 'Trámites',
                'pregunta' => '¿Cuál es el horario de atención de la Alcaldía?',
                'respuesta' => 'La Alcaldía Municipal de Achocalla atiende de lunes a viernes de 08:00 a 17:00 horas. Los días sábados se atiende de 08:30 a 12:30 horas en algunos servicios. Le recomendamos verificar el horario específico de la secretaría que necesita.',
                'orden' => 3,
            ],
            [
                'categoria' => 'Trámites',
                'pregunta' => '¿Cómo puedo solicitar el visado de un plano de construcción?',
                'respuesta' => 'Para el visado de planos debe presentar: plano elaborado por arquitecto o ingeniero habilitado, fotocopia del título de propiedad o contrato de alquiler, carnet de identidad del propietario y formulario de solicitud. El plazo de revisión es de 5 a 10 días hábiles según la complejidad.',
                'orden' => 4,
            ],
            [
                'categoria' => 'Impuestos y Pagos',
                'pregunta' => '¿Dónde y cómo puedo pagar el impuesto a la propiedad inmueble?',
                'respuesta' => 'El pago del impuesto a la propiedad inmueble (IPBI) puede realizarse en la Caja de la Alcaldía, presentando el número de inmueble o la boleta de cobro. También puede consultar y cancelar en línea a través del portal municipal. El plazo vence el 31 de octubre de cada año.',
                'orden' => 5,
            ],
            [
                'categoria' => 'Impuestos y Pagos',
                'pregunta' => '¿Qué pasa si no pago mis impuestos a tiempo?',
                'respuesta' => 'El no pago oportuno genera un recargo por mora del 1% mensual sobre el monto adeudado. Adicionalmente, se inicia el proceso coactivo de cobro. Se recomienda regularizar su situación tributaria para evitar sanciones adicionales.',
                'orden' => 6,
            ],
            [
                'categoria' => 'Participación Ciudadana',
                'pregunta' => '¿Cómo puedo presentar una queja o sugerencia al municipio?',
                'respuesta' => 'Puede presentar sus quejas y sugerencias de las siguientes formas: en persona en la Oficialía Mayor, a través del formulario de contacto de nuestro portal web, por correo electrónico o por las redes sociales oficiales del municipio. Todas las solicitudes reciben respuesta en un plazo máximo de 10 días hábiles.',
                'orden' => 7,
            ],
            [
                'categoria' => 'Participación Ciudadana',
                'pregunta' => '¿Cuándo son las audiencias públicas del municipio?',
                'respuesta' => 'Las audiencias públicas se realizan trimestralmente y son convocadas con 15 días de anticipación a través del portal web, redes sociales y medios locales. En ellas se rinde cuenta de la gestión municipal y se reciben propuestas ciudadanas para el Plan de Desarrollo Municipal.',
                'orden' => 8,
            ],
        ];

        foreach ($preguntas as $pregunta) {
            DB::table('preguntas_frecuentes')->insert([
                ...$pregunta,
                'activo' => true,
                'created_at' => now(),
            ]);
        }
    }
}
