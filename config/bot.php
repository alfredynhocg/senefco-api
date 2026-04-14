<?php

return [

    'senefco' => [
        'nombre' => env('BOT_senefco_NOMBRE', 'Alcaldía Municipal de Achocalla'),
        'sigla' => env('BOT_senefco_SIGLA', 'GAM'),

        'horarios' => [
            'Lunes a Viernes' => '8:00 AM - 12:00 PM · 2:30 PM - 6:30 PM',
            'Sábado' => '8:00 AM - 12:00 PM',
            'Domingo' => 'Cerrado',
        ],

        'ubicacion' => [
            'direccion' => env('BOT_UBICACION_DIRECCION', 'Plaza Principal s/n, Municipio'),
            'referencia' => env('BOT_UBICACION_REFERENCIA', 'Frente a la Plaza Principal'),
            'maps_link' => env('BOT_MAPS_LINK', 'https://maps.google.com/?q=senefco+municipal'),
            'latitude' => (float) env('BOT_LATITUD', -17.3895),
            'longitude' => (float) env('BOT_LONGITUD', -66.1568),
        ],

        'contacto' => [
            'telefono' => env('BOT_TELEFONO', '+591 2 XXXXXXX'),
            'email' => env('BOT_EMAIL', 'info@senefco.gob.bo'),
            'web' => env('BOT_WEB', 'https://www.senefco.gob.bo'),
        ],
    ],

    'keywords' => [
        'tramites' => ['tramite', 'tramites', 'requisito', 'requisitos', 'proceso', 'procesos', 'gestion'],
        'noticias' => ['noticia', 'noticias', 'novedad', 'novedades', 'comunicado', 'comunicados'],
        'eventos' => ['evento', 'eventos', 'actividad', 'actividades', 'agenda'],
        'secretarias' => ['secretaria', 'secretarias', 'departamento', 'oficina', 'contacto', 'contactos'],
        'audiencias' => ['audiencia', 'audiencias', 'audiencia publica', 'audiencias publicas', 'participacion', 'rendicion'],
        'horario' => ['horario', 'horarios', 'hora', 'abierto', 'atienden', 'cuando', 'atencion'],
        'ubicacion' => ['ubicacion', 'direccion', 'donde', 'lugar', 'mapa', 'llegar'],
        'soporte'     => ['ayuda', 'soporte', 'asesor', 'hablar', 'persona', 'humano'],
        'saludo'      => ['hola', 'buenas', 'buenos', 'buen dia', 'hi', 'hello', 'saludos', 'inicio'],
        'seguimiento' => ['seguimiento', 'estado de tramite', 'estado tramite', 'mi tramite', 'numero de seguimiento', 'consultar tramite', 'trm-'],
    ],

    'ia' => [
        'host' => env('OLLAMA_HOST', 'http://localhost:11434'),
        'model' => env('OLLAMA_MODEL', 'qwen2.5:7b'),
        'max_tokens' => (int) env('AI_MAX_TOKENS', 512),
        'temperature' => (float) env('AI_TEMPERATURE', 0.3),
        'timeout' => (int) env('AI_TIMEOUT_SECONDS', 30),
        'max_input_chars' => (int) env('AI_MAX_INPUT_CHARS', 500),
        'rate_limit' => 20, // mensajes por minuto por número
    ],

];
