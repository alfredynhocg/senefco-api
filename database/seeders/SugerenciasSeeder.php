<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SugerenciasSeeder extends Seeder
{
    public function run(): void
    {
        $sugerencias = [
            ['asunto' => 'Solicitud de mejoramiento de calle',        'mensaje' => 'La calle Bolívar tiene baches que dificultan el tránsito. Solicitamos su arreglo urgente.',      'email_respuesta' => 'vecino1@gmail.com',  'secretaria_destino_id' => 3, 'estado' => 'resuelto',    'respuesta' => 'Su solicitud fue atendida. La cuadrilla de obras asistirá la próxima semana.', 'respondido_por' => 1, 'respondido_at' => '2026-02-15 10:30:00'],
            ['asunto' => 'Falta de alumbrado público',                'mensaje' => 'El sector UV-15 no cuenta con alumbrado en 4 cuadras. Es peligroso en las noches.',             'email_respuesta' => 'vecino2@gmail.com',  'secretaria_destino_id' => 3, 'estado' => 'en_proceso',  'respuesta' => null, 'respondido_por' => null, 'respondido_at' => null],
            ['asunto' => 'Ruido excesivo de establecimiento nocturno', 'mensaje' => 'El local comercial de la Av. 6 de Agosto genera ruido hasta las 3am, afectando el descanso.',    'email_respuesta' => 'vecino3@gmail.com',  'secretaria_destino_id' => 8, 'estado' => 'recibido',    'respuesta' => null, 'respondido_por' => null, 'respondido_at' => null],
            ['asunto' => 'Propuesta para parque en UV-30',            'mensaje' => 'El terreno baldío en UV-30 podría convertirse en parque recreativo para los niños del barrio.', 'email_respuesta' => 'sugerencia@mail.com', 'secretaria_destino_id' => 7, 'estado' => 'en_proceso',  'respuesta' => 'Se está evaluando el terreno para el proyecto de parque. Gracias por su sugerencia.', 'respondido_por' => 1, 'respondido_at' => '2026-03-10 09:00:00'],
            ['asunto' => 'Problemas con servicio de agua',            'mensaje' => 'Llevamos 3 días sin agua en el barrio Primavera. Necesitamos solución urgente.',               'email_respuesta' => 'primavera@mail.com', 'secretaria_destino_id' => 5, 'estado' => 'resuelto',    'respuesta' => 'El problema fue identificado en la red principal y ya fue reparado.', 'respondido_por' => 1, 'respondido_at' => '2026-03-05 14:00:00'],
            ['asunto' => 'Perros callejeros en zona central',         'mensaje' => 'Existe una manada de perros callejeros agresivos en la zona central que representa un peligro.', 'email_respuesta' => null,                 'secretaria_destino_id' => 5, 'estado' => 'recibido',    'respuesta' => null, 'respondido_por' => null, 'respondido_at' => null],
        ];

        foreach ($sugerencias as $s) {
            DB::table('sugerencias')->insert($s);
        }
    }
}
