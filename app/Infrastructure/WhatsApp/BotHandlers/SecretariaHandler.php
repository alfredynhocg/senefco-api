<?php

namespace App\Infrastructure\WhatsApp\BotHandlers;

use App\Infrastructure\Secretarias\Models\Secretaria;
use App\Infrastructure\Shared\Services\WhatsAppService;
use App\Infrastructure\WhatsApp\ConversationManager;
use App\Infrastructure\WhatsApp\Enums\BotButton;
use App\Infrastructure\WhatsApp\Enums\BotState;

class SecretariaHandler
{
    public function __construct(
        private WhatsAppService $wa,
        private ConversationManager $conv,
        private MenuHandler $menu
    ) {}

    public function showLista(string $from): void
    {
        $secretarias = Secretaria::where('activa', true)
            ->orderBy('orden_organigrama')
            ->get(['id', 'nombre', 'sigla']);

        if ($secretarias->isEmpty()) {
            $this->wa->sendText($from, '😔 No hay secretarías registradas.');
            $this->menu->handle($from);

            return;
        }

        $rows = $secretarias->map(fn ($s) => [
            'id' => BotButton::PREFIX_SECRETARIA.$s->id,
            'title' => mb_substr($s->nombre, 0, 24),
            'description' => $s->sigla ?? '',
        ])->all();

        $this->wa->sendList(
            $from,
            '🏛️ Secretarías municipales',
            'Selecciona una secretaría para ver sus datos de contacto.',
            'Alcaldía Municipal',
            'Ver secretarías',
            [['title' => '🏛️ Dependencias', 'rows' => $rows]]
        );

        $this->conv->setState($from, BotState::SECRETARIAS->value);
    }

    public function showDetalle(string $from, int $secretariaId): void
    {
        $sec = Secretaria::find($secretariaId);

        if (! $sec) {
            $this->wa->sendText($from, '⚠️ Secretaría no encontrada.');
            $this->showLista($from);

            return;
        }

        $texto = "🏛️ *{$sec->nombre}*";

        if ($sec->sigla) {
            $texto .= " ({$sec->sigla})";
        }

        $texto .= "\n\n";

        if ($sec->atribuciones) {
            $texto .= "📋 *Atribuciones:*\n".mb_substr($sec->atribuciones, 0, 400)."\n\n";
        }

        if ($sec->direccion_fisica) {
            $texto .= "📍 *Dirección:* {$sec->direccion_fisica}\n";
        }

        if ($sec->telefono) {
            $texto .= "📞 *Teléfono:* {$sec->telefono}\n";
        }

        if ($sec->email) {
            $texto .= "📧 *Email:* {$sec->email}\n";
        }

        if ($sec->horario_atencion) {
            $texto .= "🕐 *Horario:* {$sec->horario_atencion}\n";
        }

        $this->wa->sendText($from, $texto);

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
            ['id' => BotButton::SECRETARIAS->value, 'title' => '🏛️ Ver más secretarías'],
            ['id' => BotButton::MENU->value,        'title' => '🏠 Menú principal'],
        ]);

        $this->conv->setState($from, BotState::SECRETARIA_DETALLE->value, ['secretaria_id' => $secretariaId]);
    }
}
