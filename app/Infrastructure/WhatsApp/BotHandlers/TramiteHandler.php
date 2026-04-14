<?php

namespace App\Infrastructure\WhatsApp\BotHandlers;

use App\Infrastructure\RequisitosTramite\Models\Requisito;
use App\Infrastructure\Shared\Services\WhatsAppService;
use App\Infrastructure\TramitesCatalogo\Models\Tramite;
use App\Infrastructure\WhatsApp\ConversationManager;
use App\Infrastructure\WhatsApp\Enums\BotButton;
use App\Infrastructure\WhatsApp\Enums\BotState;

class TramiteHandler
{
    public function __construct(
        private WhatsAppService $wa,
        private ConversationManager $conv,
        private MenuHandler $menu
    ) {}

    public function showLista(string $from): void
    {
        $tramites = Tramite::where('activo', true)
            ->orderBy('nombre')
            ->limit(10)
            ->get();

        if ($tramites->isEmpty()) {
            $this->wa->sendText($from, '😔 No hay trámites disponibles en este momento.');
            $this->menu->handle($from);

            return;
        }

        $rows = $tramites->map(fn ($t) => [
            'id' => BotButton::PREFIX_TRAMITE.$t->id,
            'title' => mb_substr($t->nombre, 0, 24),
            'description' => $t->modalidad ? mb_substr($t->modalidad, 0, 72) : '',
        ])->all();

        $this->wa->sendList(
            $from,
            '📋 Trámites disponibles',
            'Selecciona el trámite para ver sus requisitos y proceso.',
            'Alcaldía Municipal',
            'Ver trámites',
            [['title' => '📋 Trámites', 'rows' => $rows]]
        );

        $this->conv->setState($from, BotState::TRAMITES_LISTA->value);
    }

    public function showDetalle(string $from, int $tramiteId): void
    {
        $tramite = Tramite::find($tramiteId);

        if (! $tramite) {
            $this->wa->sendText($from, '⚠️ Trámite no encontrado.');
            $this->showLista($from);

            return;
        }

        $texto = "📋 *{$tramite->nombre}*\n\n";

        if ($tramite->descripcion) {
            $texto .= "📝 {$tramite->descripcion}\n\n";
        }

        if ($tramite->procedimiento) {
            $texto .= "*Procedimiento:*\n{$tramite->procedimiento}\n\n";
        }

        if ($tramite->costo !== null && $tramite->costo > 0) {
            $moneda = $tramite->moneda ?? 'Bs';
            $texto .= "💰 *Costo:* {$tramite->costo} {$moneda}\n";
        } else {
            $texto .= "💰 *Costo:* Gratuito\n";
        }

        if ($tramite->dias_habiles_resolucion) {
            $texto .= "⏱️ *Plazo:* {$tramite->dias_habiles_resolucion} días hábiles\n";
        }

        if ($tramite->modalidad) {
            $texto .= "🔄 *Modalidad:* {$tramite->modalidad}\n";
        }

        if ($tramite->normativa_base) {
            $texto .= "📜 *Normativa:* {$tramite->normativa_base}\n";
        }

        $this->wa->sendText($from, $texto);

        $requisitos = Requisito::where('tramite_id', $tramiteId)
            ->orderBy('orden')
            ->get();

        if ($requisitos->isNotEmpty()) {
            $reqTexto = "📎 *Requisitos:*\n\n";
            foreach ($requisitos as $i => $req) {
                $reqTexto .= ($i + 1).". {$req->descripcion}\n";
                if ($req->nota) {
                    $reqTexto .= "   _(Nota: {$req->nota})_\n";
                }
            }
            $this->wa->sendText($from, $reqTexto);
        }

        if ($tramite->url_formulario) {
            $this->wa->sendText($from, "📄 *Formulario:* {$tramite->url_formulario}");
        }

        $tieneEtapas = \App\Infrastructure\TramiteSolicitudes\Models\TramiteEtapa::where('tramite_id', $tramiteId)->exists();

        $buttons = [
            ['id' => BotButton::TRAMITES->value, 'title' => '📋 Ver más trámites'],
            ['id' => BotButton::MENU->value,     'title' => '🏠 Menú principal'],
        ];

        if ($tieneEtapas) {
            $buttons = [
                ['id' => BotButton::SEGUIMIENTO->value, 'title' => '🔍 Consultar seguimiento'],
                ['id' => BotButton::TRAMITES->value,    'title' => '📋 Ver más trámites'],
                ['id' => BotButton::MENU->value,        'title' => '🏠 Menú principal'],
            ];
        }

        $footer = $tieneEtapas
            ? 'Para iniciar tu solicitud acércate a las oficinas municipales.'
            : '';

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', $buttons, '', $footer);

        $this->conv->setState($from, BotState::TRAMITE_DETALLE->value, ['tramite_id' => $tramiteId]);
    }
}
