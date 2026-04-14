<?php

namespace App\Http\Controllers\Api\WhatsApp;

use App\Http\Controllers\Controller;
use App\Infrastructure\Shared\Services\WhatsAppBotService;
use App\Infrastructure\Shared\Services\WhatsAppService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class WhatsAppController extends Controller
{
    public function __construct(
        private WhatsAppBotService $bot,
        private WhatsAppService $wa,
    ) {}

    public function verify(Request $request): Response|JsonResponse
    {
        $mode = $request->query('hub_mode');
        $token = $request->query('hub_verify_token');
        $challenge = $request->query('hub_challenge');

        if ($mode === 'subscribe' && $token === config('whatsapp.verify_token')) {
            return response($challenge, 200);
        }

        return response()->json(['error' => 'Verification failed'], 403);
    }

    public function receive(Request $request): JsonResponse
    {
        $appSecret = config('whatsapp.app_secret');
        if (empty($appSecret)) {
            \Illuminate\Support\Facades\Log::warning('WhatsApp app_secret no configurado — webhook sin verificación de firma');
        } else {
            $signature = $request->header('X-Hub-Signature-256', '');
            $expected = 'sha256='.hash_hmac('sha256', $request->getContent(), $appSecret);
            if (! hash_equals($expected, $signature)) {
                return response()->json(['error' => 'Invalid signature'], 403);
            }
        }

        $payload = $request->all();

        foreach ($payload['entry'] ?? [] as $entry) {
            foreach ($entry['changes'] ?? [] as $change) {
                $value = $change['value'] ?? [];

                if (isset($value['statuses'])) {
                    continue;
                }

                $nombre = $value['contacts'][0]['profile']['name'] ?? null;

                foreach ($value['messages'] ?? [] as $message) {
                    $messageId = $message['id'] ?? null;

                    try {
                        if ($messageId && ! Cache::add("wamsg:{$messageId}", true, 300)) {
                            continue;
                        }
                    } catch (\Throwable) {
                        // Si el caché falla, procesamos igual
                    }

                    $from = $message['from'];
                    $type = $message['type'];

                    \Log::info('WhatsApp mensaje recibido', [
                        'id' => $messageId,
                        'from' => $from,
                        'nombre' => $nombre,
                        'type' => $type,
                        'body' => $message['text']['body'] ?? '[no text]',
                    ]);

                    $this->wa->sendTyping($from, $messageId);

                    try {
                        $this->bot->handleMessage($from, $type, $message, $nombre);
                    } catch (\Throwable $e) {
                        \Log::error('[WhatsApp] Error en handleMessage', [
                            'from' => $from,
                            'error' => $e->getMessage(),
                            'file' => $e->getFile(),
                            'line' => $e->getLine(),
                        ]);
                    }
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
