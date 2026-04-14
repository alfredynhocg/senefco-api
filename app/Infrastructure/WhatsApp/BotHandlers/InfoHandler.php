<?php

namespace App\Infrastructure\WhatsApp\BotHandlers;

use App\Infrastructure\AudienciasPublicas\Models\AudienciaPublica;
use App\Infrastructure\Autoridades\Models\Autoridad;
use App\Infrastructure\Comunicados\Models\Comunicado;
use App\Infrastructure\Eventos\Models\Evento;
use App\Infrastructure\Noticias\Models\Noticia;
use App\Infrastructure\Shared\Services\WhatsAppService;
use App\Infrastructure\WhatsApp\ConversationManager;
use App\Infrastructure\WhatsApp\Enums\BotButton;
use App\Infrastructure\WhatsApp\Enums\BotState;

class InfoHandler
{
    public function __construct(
        private WhatsAppService $wa,
        private ConversationManager $conv,
        private MenuHandler $menu
    ) {}

    public function showNoticias(string $from): void
    {
        $noticias = Noticia::where('estado', 'publicado')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get(['id', 'titulo', 'entradilla', 'fecha_publicacion', 'imagen_principal_url']);

        if ($noticias->isEmpty()) {
            $this->wa->sendText($from, '😔 No hay noticias publicadas en este momento.');
            $this->menu->handle($from);

            return;
        }

        $this->wa->sendText($from, '📰 *Últimas noticias del municipio*');

        foreach ($noticias as $noticia) {
            $fecha = $noticia->fecha_publicacion?->format('d/m/Y') ?? '';

            $titulo = mb_substr($noticia->titulo ?? '', 0, 100);
            $entradilla = $noticia->entradilla ? mb_substr($noticia->entradilla, 0, 150) : '';
            $body = "*{$titulo}*";
            if ($fecha) {
                $body .= "\n📅 {$fecha}";
            }
            if ($entradilla) {
                $body .= "\n\n{$entradilla}";
            }

            $imageUrl = null;
            if ($noticia->imagen_principal_url) {
                $raw = $noticia->imagen_principal_url;
                if (str_starts_with($raw, 'http')) {
                    $imageUrl = $raw;
                } else {
                    $imageUrl = rtrim(config('app.url'), '/').'/'.ltrim($raw, '/');
                }
            }

            $buttons = [
                ['id' => BotButton::PREFIX_NOTICIA.$noticia->id, 'title' => 'Ver detalle'],
            ];

            if ($imageUrl) {
                try {
                    $this->wa->sendButtonsWithImage($from, $imageUrl, $body, $buttons, '¿Quieres leer más?');

                    continue;
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('[InfoHandler] sendButtonsWithImage falló, usando fallback sin imagen', ['error' => $e->getMessage()]);
                }
            }

            $this->wa->sendButtons($from, $body, $buttons, '', '¿Quieres leer más?');
        }

        $portalUrl = rtrim(config('services.whatsapp.portal_url', config('app.url')), '/').'/noticias';
        $this->wa->sendCtaUrl(
            $from,
            '¿Quieres ver todas las noticias del municipio?',
            '📰 Ver todas las noticias',
            $portalUrl,
        );

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
            ['id' => BotButton::MENU->value, 'title' => '🏠 Menú principal'],
        ]);

        $this->conv->setState($from, BotState::NOTICIAS->value);
    }

    public function showDetalleNoticia(string $from, int $noticiaId): void
    {
        $noticia = Noticia::find($noticiaId);

        if (! $noticia) {
            $this->wa->sendText($from, '⚠️ Noticia no encontrada.');
            $this->showNoticias($from);

            return;
        }

        $fecha = $noticia->fecha_publicacion?->format('d/m/Y') ?? '';
        $texto = "📰 *{$noticia->titulo}*\n";

        if ($fecha) {
            $texto .= "📅 {$fecha}\n";
        }

        $texto .= "\n".($noticia->entradilla ?? '');

        $this->wa->sendText($from, $texto);

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
            ['id' => BotButton::NOTICIAS->value, 'title' => '📰 Más noticias'],
            ['id' => BotButton::MENU->value,     'title' => '🏠 Menú principal'],
        ]);

        $this->conv->setState($from, BotState::NOTICIA_DETALLE->value, ['noticia_id' => $noticiaId]);
    }

    public function showEventos(string $from): void
    {
        $eventos = Evento::where('publico', true)
            ->orderByDesc('created_at')
            ->limit(3)
            ->get(['id', 'titulo', 'descripcion', 'fecha_inicio', 'lugar']);

        if ($eventos->isEmpty()) {
            $this->wa->sendText($from, '😔 No hay eventos registrados en este momento.');
            $this->menu->handle($from);

            return;
        }

        $this->wa->sendText($from, '📅 *Eventos del municipio*');

        foreach ($eventos as $evento) {
            $titulo = mb_substr($evento->titulo ?? '', 0, 100);
            $body = "*{$titulo}*";

            if ($evento->fecha_inicio) {
                $body .= "\n🗓️ ".$evento->fecha_inicio->format('d/m/Y');
            }
            if ($evento->lugar) {
                $body .= "\n📍 ".mb_substr($evento->lugar, 0, 80);
            }
            if ($evento->descripcion) {
                $body .= "\n\n".mb_substr($evento->descripcion, 0, 150);
            }

            $this->wa->sendButtons($from, $body, [
                ['id' => BotButton::PREFIX_EVENTO.$evento->id, 'title' => 'Ver detalle'],
            ], '', '¿Quieres saber más?');
        }

        $portalUrl = rtrim(config('services.whatsapp.portal_url', config('app.url')), '/').'/eventos';
        $this->wa->sendCtaUrl(
            $from,
            '¿Quieres ver todos los eventos del municipio?',
            '📅 Ver todos los eventos',
            $portalUrl,
        );

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
            ['id' => BotButton::MENU->value, 'title' => '🏠 Menú principal'],
        ]);

        $this->conv->setState($from, BotState::EVENTOS->value);
    }

    public function showDetalleEvento(string $from, int $eventoId): void
    {
        $evento = Evento::find($eventoId);

        if (! $evento) {
            $this->wa->sendText($from, '⚠️ Evento no encontrado.');
            $this->showEventos($from);

            return;
        }

        $inicio = $evento->fecha_inicio?->format('d/m/Y H:i') ?? 'Por confirmar';
        $fin = $evento->fecha_fin?->format('d/m/Y H:i') ?? '';

        $texto = "📅 *{$evento->titulo}*\n\n";
        $texto .= "🗓️ *Inicio:* {$inicio}\n";

        if ($fin) {
            $texto .= "🗓️ *Fin:* {$fin}\n";
        }

        if ($evento->lugar) {
            $texto .= "📍 *Lugar:* {$evento->lugar}\n";
        }

        if ($evento->descripcion) {
            $texto .= "\n{$evento->descripcion}";
        }

        if ($evento->url_transmision) {
            $texto .= "\n\n🔴 *Transmisión:* {$evento->url_transmision}";
        }

        $this->wa->sendText($from, $texto);

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
            ['id' => BotButton::EVENTOS->value, 'title' => '📅 Ver más eventos'],
            ['id' => BotButton::MENU->value,    'title' => '🏠 Menú principal'],
        ]);

        $this->conv->setState($from, BotState::EVENTO_DETALLE->value, ['evento_id' => $eventoId]);
    }

    public function showComunicados(string $from): void
    {
        $comunicados = Comunicado::where('estado', 'publicado')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get(['id', 'titulo', 'resumen', 'fecha_publicacion', 'imagen_url']);

        if ($comunicados->isEmpty()) {
            $this->wa->sendText($from, '😔 No hay comunicados publicados en este momento.');
            $this->menu->handle($from);

            return;
        }

        $this->wa->sendText($from, '📢 *Comunicados oficiales*');

        foreach ($comunicados as $comunicado) {
            $fecha = $comunicado->fecha_publicacion?->format('d/m/Y') ?? '';

            $titulo = mb_substr($comunicado->titulo ?? '', 0, 100);
            $resumen = $comunicado->resumen ? mb_substr($comunicado->resumen, 0, 150) : '';
            $body = "*{$titulo}*";
            if ($fecha) {
                $body .= "\n📅 {$fecha}";
            }
            if ($resumen) {
                $body .= "\n\n{$resumen}";
            }

            $imageUrl = null;
            if ($comunicado->imagen_url) {
                $raw = $comunicado->imagen_url;
                $imageUrl = str_starts_with($raw, 'http')
                    ? $raw
                    : rtrim(config('app.url'), '/').'/'.ltrim($raw, '/');
            }

            $buttons = [
                ['id' => BotButton::PREFIX_COMUNICADO.$comunicado->id, 'title' => 'Ver detalle'],
            ];

            if ($imageUrl) {
                try {
                    $this->wa->sendButtonsWithImage($from, $imageUrl, $body, $buttons, '¿Quieres leer más?');

                    continue;
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('[InfoHandler] sendButtonsWithImage (comunicado) falló', ['error' => $e->getMessage()]);
                }
            }

            $this->wa->sendButtons($from, $body, $buttons, '', '¿Quieres leer más?');
        }

        $portalUrl = rtrim(config('services.whatsapp.portal_url', config('app.url')), '/').'/comunicados';
        $this->wa->sendCtaUrl(
            $from,
            '¿Quieres ver todos los comunicados?',
            '📢 Ver todos los comunicados',
            $portalUrl,
        );

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
            ['id' => BotButton::MENU->value, 'title' => '🏠 Menú principal'],
        ]);

        $this->conv->setState($from, BotState::COMUNICADOS->value);
    }

    public function showDetalleComunicado(string $from, int $comunicadoId): void
    {
        $comunicado = Comunicado::find($comunicadoId);

        if (! $comunicado) {
            $this->wa->sendText($from, '⚠️ Comunicado no encontrado.');
            $this->showComunicados($from);

            return;
        }

        $fecha = $comunicado->fecha_publicacion?->format('d/m/Y') ?? '';
        $texto = "📢 *{$comunicado->titulo}*\n";
        if ($fecha) {
            $texto .= "📅 {$fecha}\n";
        }
        $texto .= "\n".($comunicado->resumen ?? '');

        $this->wa->sendText($from, $texto);

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
            ['id' => BotButton::COMUNICADOS->value, 'title' => '📢 Más comunicados'],
            ['id' => BotButton::MENU->value,        'title' => '🏠 Menú principal'],
        ]);

        $this->conv->setState($from, BotState::COMUNICADO_DETALLE->value, ['comunicado_id' => $comunicadoId]);
    }

    public function showAudienciasPublicas(string $from): void
    {
        $audiencias = AudienciaPublica::where('estado', '!=', 'cancelada')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get(['id', 'titulo', 'descripcion', 'tipo', 'estado', 'afiche_url', 'enlace_virtual']);

        if ($audiencias->isEmpty()) {
            $this->wa->sendText($from, '😔 No hay audiencias públicas registradas en este momento.');
            $this->menu->handle($from);

            return;
        }

        $this->wa->sendText($from, '🎙️ *Audiencias Públicas del municipio*');

        $estadoEmoji = ['convocada' => '🔵', 'realizada' => '✅', 'cancelada' => '❌', 'postergada' => '⏸️'];
        $tipoLabel = ['inicial' => 'Inicial', 'seguimiento' => 'Seguimiento', 'rendicion' => 'Rendición de Cuentas'];

        foreach ($audiencias as $audiencia) {
            $titulo = mb_substr($audiencia->titulo ?? '', 0, 100);
            $emoji = $estadoEmoji[$audiencia->estado] ?? '🔵';
            $body = "*{$titulo}*";
            $body .= "\n{$emoji} ".ucfirst($audiencia->estado);
            $body .= "\n🏷️ ".($tipoLabel[$audiencia->tipo] ?? ucfirst($audiencia->tipo));

            if ($audiencia->descripcion) {
                $body .= "\n\n".mb_substr($audiencia->descripcion, 0, 150);
            }

            $imageUrl = null;
            if ($audiencia->afiche_url) {
                $raw = $audiencia->afiche_url;
                $imageUrl = str_starts_with($raw, 'http')
                    ? $raw
                    : rtrim(config('app.url'), '/').'/'.ltrim($raw, '/');
            }

            $buttons = [
                ['id' => BotButton::PREFIX_AUDIENCIA.$audiencia->id, 'title' => 'Ver detalle'],
            ];

            if ($imageUrl) {
                try {
                    $this->wa->sendButtonsWithImage($from, $imageUrl, $body, $buttons, 'Audiencia Pública');

                    continue;
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('[InfoHandler] sendButtonsWithImage (audiencia) falló', ['error' => $e->getMessage()]);
                }
            }

            $this->wa->sendButtons($from, $body, $buttons, '', 'Audiencia Pública');
        }

        $portalUrl = rtrim(config('services.whatsapp.portal_url', config('app.url')), '/').'/audiencias-publicas';
        $this->wa->sendCtaUrl(
            $from,
            '¿Quieres ver todas las audiencias públicas?',
            '🎙️ Ver todas las audiencias',
            $portalUrl,
        );

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
            ['id' => BotButton::MENU->value, 'title' => '🏠 Menú principal'],
        ]);

        $this->conv->setState($from, BotState::AUDIENCIAS_PUBLICAS->value);
    }

    public function showDetalleAudiencia(string $from, int $audienciaId): void
    {
        $audiencia = AudienciaPublica::find($audienciaId);

        if (! $audiencia) {
            $this->wa->sendText($from, '⚠️ Audiencia pública no encontrada.');
            $this->showAudienciasPublicas($from);

            return;
        }

        $estadoEmoji = ['convocada' => '🔵', 'realizada' => '✅', 'cancelada' => '❌', 'postergada' => '⏸️'];
        $tipoLabel = ['inicial' => 'Inicial', 'seguimiento' => 'Seguimiento', 'rendicion' => 'Rendición de Cuentas'];

        $texto = "🎙️ *{$audiencia->titulo}*\n";
        $texto .= ($estadoEmoji[$audiencia->estado] ?? '🔵').' Estado: '.ucfirst($audiencia->estado)."\n";
        $texto .= '🏷️ Tipo: '.($tipoLabel[$audiencia->tipo] ?? ucfirst($audiencia->tipo))."\n";

        if ($audiencia->asistentes) {
            $texto .= "👥 Asistentes: {$audiencia->asistentes}\n";
        }

        if ($audiencia->descripcion) {
            $texto .= "\n".mb_substr($audiencia->descripcion, 0, 400);
        }

        if ($audiencia->enlace_virtual) {
            $texto .= "\n\n🔗 *Enlace virtual:*\n{$audiencia->enlace_virtual}";
        }

        $this->wa->sendText($from, $texto);

        $buttons = [
            ['id' => BotButton::AUDIENCIAS_PUBLICAS->value, 'title' => '🎙️ Más audiencias'],
            ['id' => BotButton::MENU->value,                'title' => '🏠 Menú principal'],
        ];

        if ($audiencia->acta_url) {
            $actaUrl = str_starts_with($audiencia->acta_url, 'http')
                ? $audiencia->acta_url
                : rtrim(config('app.url'), '/').'/'.ltrim($audiencia->acta_url, '/');
            $this->wa->sendCtaUrl($from, '📄 Acta de la audiencia disponible', 'Descargar acta', $actaUrl);
        }

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', $buttons);

        $this->conv->setState($from, BotState::AUDIENCIA_DETALLE->value, ['audiencia_id' => $audienciaId]);
    }

    public function showAutoridades(string $from): void
    {
        $autoridades = Autoridad::where('activo', true)
            ->orderBy('orden')
            ->limit(3)
            ->get(['id', 'nombre', 'apellido', 'cargo', 'tipo', 'foto_url']);

        if ($autoridades->isEmpty()) {
            $this->wa->sendText($from, '😔 No hay autoridades registradas en este momento.');
            $this->menu->handle($from);

            return;
        }

        $this->wa->sendText($from, '🏛️ *Autoridades municipales*');

        foreach ($autoridades as $autoridad) {
            $nombre = mb_substr($autoridad->nombre.' '.$autoridad->apellido, 0, 100);
            $body = "*{$nombre}*";
            $body .= "\n🏷️ ".ucfirst($autoridad->tipo);
            $body .= "\n".mb_substr($autoridad->cargo ?? '', 0, 100);

            $imageUrl = null;
            if ($autoridad->foto_url) {
                $raw = $autoridad->foto_url;
                $imageUrl = str_starts_with($raw, 'http')
                    ? $raw
                    : rtrim(config('app.url'), '/').'/'.ltrim($raw, '/');
            }

            $buttons = [
                ['id' => BotButton::PREFIX_AUTORIDAD.$autoridad->id, 'title' => 'Ver perfil'],
            ];

            if ($imageUrl) {
                try {
                    $this->wa->sendButtonsWithImage($from, $imageUrl, $body, $buttons, 'Autoridad Municipal');

                    continue;
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('[InfoHandler] sendButtonsWithImage (autoridad) falló', ['error' => $e->getMessage()]);
                }
            }

            $this->wa->sendButtons($from, $body, $buttons, '', 'Autoridad Municipal');
        }

        $portalUrl = rtrim(config('services.whatsapp.portal_url', config('app.url')), '/').'/institucional/autoridades';
        $this->wa->sendCtaUrl(
            $from,
            '¿Quieres ver todas las autoridades del municipio?',
            '🏛️ Ver todas las autoridades',
            $portalUrl,
        );

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
            ['id' => BotButton::MENU->value, 'title' => '🏠 Menú principal'],
        ]);

        $this->conv->setState($from, BotState::AUTORIDADES->value);
    }

    public function showDetalleAutoridad(string $from, int $autoridadId): void
    {
        $autoridad = Autoridad::find($autoridadId);

        if (! $autoridad) {
            $this->wa->sendText($from, '⚠️ Autoridad no encontrada.');
            $this->showAutoridades($from);

            return;
        }

        $texto = "🏛️ *{$autoridad->nombre} {$autoridad->apellido}*\n";
        $texto .= '🏷️ '.ucfirst($autoridad->tipo)."\n";
        $texto .= "💼 {$autoridad->cargo}\n";

        if ($autoridad->email_institucional) {
            $texto .= "✉️ {$autoridad->email_institucional}\n";
        }
        if ($autoridad->fecha_inicio_cargo) {
            $texto .= '📅 En funciones desde: '.$autoridad->fecha_inicio_cargo->format('d/m/Y')."\n";
        }
        if ($autoridad->perfil_profesional) {
            $texto .= "\n".mb_substr($autoridad->perfil_profesional, 0, 300);
        }

        $this->wa->sendText($from, $texto);

        $this->wa->sendButtons($from, '¿Qué deseas hacer?', [
            ['id' => BotButton::AUTORIDADES->value, 'title' => '🏛️ Más autoridades'],
            ['id' => BotButton::MENU->value,        'title' => '🏠 Menú principal'],
        ]);

        $this->conv->setState($from, BotState::AUTORIDAD_DETALLE->value, ['autoridad_id' => $autoridadId]);
    }
}
