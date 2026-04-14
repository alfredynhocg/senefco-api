<?php

namespace App\Infrastructure\WhatsApp\BotHandlers;

use App\Infrastructure\Shared\Services\WhatsAppService;
use App\Infrastructure\TramitesCatalogo\Models\Tramite;
use App\Infrastructure\TramiteSolicitudes\Models\TramiteEtapa;
use App\Infrastructure\TramiteSolicitudes\Models\TramiteSolicitud;
use App\Infrastructure\TramiteSolicitudes\Models\TramiteSolicitudHistorial;
use App\Infrastructure\WhatsApp\ConversationManager;
use App\Infrastructure\WhatsApp\Enums\BotButton;
use App\Infrastructure\WhatsApp\Enums\BotState;

class SeguimientoHandler
{
    public function __construct(
        private WhatsAppService $wa,
        private ConversationManager $conv,
        private MenuHandler $menu,
    ) {}

    public function pedirNumero(string $from): void
    {
        $this->wa->sendText($from,
            "🔍 *Consulta de estado de trámite*\n\n".
            "Escribe tu *número de seguimiento* o tu *número de CI* para buscar tu trámite.\n\n".
            "_Ejemplo número: TRM-202604-00001_\n".
            '_Ejemplo CI: 5821034_'
        );
        $this->conv->setState($from, BotState::SEGUIMIENTO_TRAMITE->value);
    }

    public function buscarPorNumero(string $from, string $texto): void
    {
        $texto = trim($texto);

        $solicitud = null;

        if (str_starts_with(strtoupper($texto), 'TRM-')) {
            $solicitud = TramiteSolicitud::where('numero_seguimiento', strtoupper($texto))
                ->with(['tramite', 'historial'])
                ->first();
        } else {
            $solicitud = TramiteSolicitud::where('ci', $texto)
                ->where('phone', $from)
                ->with(['tramite', 'historial'])
                ->orderByDesc('id')
                ->first();

            if (! $solicitud) {
                $solicitud = TramiteSolicitud::where('ci', $texto)
                    ->with(['tramite', 'historial'])
                    ->orderByDesc('id')
                    ->first();
            }
        }

        if (! $solicitud) {
            $this->wa->sendText($from,
                "⚠️ No se encontro ningún trámite con *{$texto}*.\n\n".
                'Verifica que hayas escrito correctamente el número de seguimiento (TRM-XXXXXX-XXXXX) o tu CI.'
            );
            $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
                ['id' => BotButton::SEGUIMIENTO->value, 'title' => '🔍 Intentar de nuevo'],
                ['id' => BotButton::MENU->value,        'title' => '🏠 Menú principal'],
            ]);
            $this->conv->setState($from, BotState::MENU->value);

            return;
        }

        $this->enviarEstado($from, $solicitud);
        $this->conv->setState($from, BotState::MENU->value);
    }

    private function enviarEstado(string $from, TramiteSolicitud $solicitud): void
    {
        $etapas = TramiteEtapa::where('tramite_id', $solicitud->tramite_id)
            ->orderBy('orden')
            ->get();

        $totalEtapas = $etapas->count();
        $etapaActual = $solicitud->etapa_actual;

        $estadoLabel = match ($solicitud->estado) {
            'completado' => '✅ Completado',
            'cancelado'  => '❌ Cancelado',
            default      => '🔄 En proceso',
        };

        $progreso = $totalEtapas > 0 ? round(($etapaActual / $totalEtapas) * 100) : 0;
        $barra    = $this->barraProgreso($etapaActual, $totalEtapas);

        $texto  = "📋 *Estado de tu Trámite*\n\n";
        $texto .= "📌 *Número:* {$solicitud->numero_seguimiento}\n";
        $texto .= "📝 *Trámite:* {$solicitud->tramite->nombre}\n";
        $texto .= "👤 *Solicitante:* {$solicitud->nombre_ciudadano}\n";
        if ($solicitud->ci) {
            $texto .= "🪪 *CI:* {$solicitud->ci}\n";
        }
        $texto .= "📊 *Estado:* {$estadoLabel}\n\n";
        $texto .= "*Progreso: {$progreso}% {$barra}*\n\n";

        $this->wa->sendText($from, $texto);

        $etapasTexto = "📍 *Etapas del trámite:*\n\n";
        foreach ($etapas as $etapa) {
            if ($etapa->orden < $etapaActual || ($etapa->orden === $etapaActual && $solicitud->estado === 'completado')) {
                $icono = '✅';
            } elseif ($etapa->orden === $etapaActual) {
                $icono = '🔄';
            } else {
                $icono = '⬜';
            }
            $etapasTexto .= "{$icono} *{$etapa->orden}. {$etapa->nombre}*\n";
            if ($etapa->orden === $etapaActual && $etapa->instruccion_ciudadano && $solicitud->estado !== 'completado') {
                $etapasTexto .= "   _{$etapa->instruccion_ciudadano}_\n";
            }
        }

        $historial = $solicitud->historial;
        if ($historial && $historial->isNotEmpty()) {
            $ultimo = $historial->last();
            if ($ultimo->observacion) {
                $etapasTexto .= "\n💬 *Última nota del funcionario:*\n_{$ultimo->observacion}_\n";
            }
        }

        $this->wa->sendText($from, $etapasTexto);

        $this->wa->sendButtons($from, '¿Necesitas algo más?', [
            ['id' => BotButton::SEGUIMIENTO->value, 'title' => '🔍 Otro trámite'],
            ['id' => BotButton::MENU->value,        'title' => '🏠 Menú principal'],
        ]);
    }

    private function barraProgreso(int $actual, int $total): string
    {
        if ($total === 0) {
            return '';
        }
        $llenos = (int) round(($actual / $total) * 5);
        $vacios = 5 - $llenos;

        return str_repeat('🟩', $llenos).str_repeat('⬜', $vacios);
    }
}
