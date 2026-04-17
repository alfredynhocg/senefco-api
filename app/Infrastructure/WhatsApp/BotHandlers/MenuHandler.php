<?php

namespace App\Infrastructure\WhatsApp\BotHandlers;

use App\Infrastructure\Shared\Services\WhatsAppService;
use App\Infrastructure\WhatsApp\ConversationManager;
use App\Infrastructure\WhatsApp\Enums\BotButton;
use App\Infrastructure\WhatsApp\Enums\BotState;

class MenuHandler
{
    public function __construct(
        private WhatsAppService $wa,
        private ConversationManager $conv
    ) {}

    public function handle(string $from): void
    {
        $nombre = config('bot.cenefco.nombre');

        $this->wa->sendList(
            $from,
            "🏛️ {$nombre}",
            '¿En qué puedo ayudarte hoy?',
            'Gobierno Municipal al servicio del ciudadano',
            'Ver opciones',
            [
                [
                    'title' => '📋 Servicios',
                    'rows' => [
                        ['id' => BotButton::TRAMITES->value,    'title' => '📋 Trámites',    'description' => 'Consulta requisitos y procesos'],
                        ['id' => BotButton::SECRETARIAS->value,  'title' => '🏛️ Secretarías',   'description' => 'Oficinas y datos de contacto'],
                        ['id' => BotButton::AUTORIDADES->value,  'title' => '👤 Autoridades',   'description' => 'Autoridades del municipio'],
                    ],
                ],
                [
                    'title' => '📢 Información',
                    'rows' => [
                        ['id' => BotButton::NOTICIAS->value,           'title' => '📰 Noticias',           'description' => 'Últimas noticias del municipio'],
                        ['id' => BotButton::COMUNICADOS->value,        'title' => '📢 Comunicados',        'description' => 'Comunicados oficiales'],
                        ['id' => BotButton::EVENTOS->value,            'title' => '📅 Eventos',            'description' => 'Agenda de eventos próximos'],
                        ['id' => BotButton::AUDIENCIAS_PUBLICAS->value, 'title' => '🎙️ Audiencias Públicas', 'description' => 'Audiencias y participación ciudadana'],
                        ['id' => BotButton::HORARIO->value,            'title' => '🕐 Horarios',           'description' => 'Horarios de atención'],
                        // ['id' => BotButton::UBICACION->value,          'title' => '📍 Ubicación',          'description' => 'Cómo llegar a la alcaldía'],
                        ['id' => BotButton::SEGUIMIENTO->value,          'title' => '📍 Seguimiento',       'description' => 'Seguimiento de Trámites'],
                        ['id' => BotButton::SOPORTE->value,            'title' => '📞 Soporte',            'description' => 'Hablar con un funcionario'],
                    ],
                ],
            ]
        );

        $this->conv->setState($from, BotState::MENU->value);

        $this->wa->sendButtons($from, '¿Necesitas hablar con una persona?', [
            ['id' => BotButton::SOPORTE->value, 'title' => '🙋 Hablar con operador'],
        ]);
    }

    public function handleHorario(string $from): void
    {
        $nombre = config('bot.cenefco.nombre');
        $horarios = config('bot.cenefco.horarios');

        $texto = "🕐 *Horarios de atención — {$nombre}*\n\n";
        foreach ($horarios as $dia => $hora) {
            $texto .= "📅 *{$dia}:* {$hora}\n";
        }

        $this->wa->sendText($from, $texto);
        $this->handle($from);
    }

    public function handleUbicacion(string $from): void
    {
        $loc = config('bot.cenefco.ubicacion');
        $nombre = config('bot.cenefco.nombre');

        $this->wa->sendLocation(
            $from,
            $loc['latitude'],
            $loc['longitude'],
            $nombre,
            $loc['direccion']
        );

        $this->wa->sendText(
            $from,
            "📍 *{$loc['direccion']}*\n🏷️ Referencia: {$loc['referencia']}\n\n🗺️ {$loc['maps_link']}"
        );

        $this->handle($from);
    }

    public function handleSoporte(string $from): void
    {
        $tel = config('bot.cenefco.contacto.telefono');
        $this->wa->sendText(
            $from,
            "📞 *Atención ciudadana*\n\nUn operador te atenderá en breve.\n\nTambién puedes contactarnos directamente:\n📲 {$tel}"
        );
        $this->conv->setState($from, BotState::SOPORTE->value);
    }
}
