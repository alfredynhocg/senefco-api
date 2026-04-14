<?php

namespace App\Http\Controllers\Api\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Traits\TelegramServiceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TelegramManagementController extends Controller
{
    use TelegramServiceTrait;

    public function __construct()
    {
        $this->initializeTelegramServices();
    }

    // ─── Configuración del webhook ────────────────────────────────────────────

    /**
     * Registra el webhook en Telegram.
     * GET /api/telegram/set-webhook?url=https://tudominio.com/api/telegram/webhook
     */
    public function setWebhook(Request $request): JsonResponse
    {
        $url = $request->query('url');

        if (! $url) {
            return response()->json(['error' => 'Falta el parámetro "url"'], 422);
        }

        $secret = config('telegram.webhook_secret');
        $response = $this->telegram->setWebhook($url, $secret);

        return response()->json($response);
    }

    /**
     * Muestra información del webhook actualmente registrado.
     * GET /api/telegram/webhook-info
     */
    public function webhookInfo(): JsonResponse
    {
        return response()->json($this->telegram->getWebhookInfo());
    }

    /**
     * Elimina el webhook registrado.
     * DELETE /api/telegram/webhook
     */
    public function deleteWebhook(): JsonResponse
    {
        return response()->json($this->telegram->deleteWebhook());
    }

    // ─── Pruebas e información ───────────────────────────────────────────────

    /**
     * Simula el menú del bot en un chat.
     * GET /api/telegram/bot-test?chat_id=123456789
     */
    public function botTest(Request $request): JsonResponse
    {
        $chatId = $request->query('chat_id');

        if (! $chatId) {
            return response()->json(['error' => 'Falta el parámetro "chat_id"'], 422);
        }

        $this->bot->sendBienvenida($chatId);

        return response()->json(['status' => 'bot menu sent', 'chat_id' => $chatId]);
    }

    /**
     * Información del bot (username, id, etc).
     * GET /api/telegram/me
     */
    public function me(): JsonResponse
    {
        return response()->json($this->telegram->getMe());
    }
}
