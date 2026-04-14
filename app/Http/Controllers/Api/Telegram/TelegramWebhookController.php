<?php

namespace App\Http\Controllers\Api\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Traits\TelegramServiceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TelegramWebhookController extends Controller
{
    use TelegramServiceTrait;

    public function __construct()
    {
        $this->initializeTelegramServices();
    }

    public function webhook(Request $request): JsonResponse
    {
        $secret = config('telegram.webhook_secret');
        if (! $secret) {
            return response()->json(['error' => 'Webhook secret not configured'], 500);
        }
        $header = $request->header('X-Telegram-Bot-Api-Secret-Token', '');
        if (! hash_equals($secret, $header)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $update = $request->all();

        \Log::info('Telegram update recibido', ['update_id' => $update['update_id'] ?? null]);

        $updateId = $update['update_id'] ?? null;
        if ($updateId && Cache::has("tgupd:{$updateId}")) {
            return response()->json(['status' => 'duplicate']);
        }
        if ($updateId) {
            Cache::put("tgupd:{$updateId}", true, now()->addMinutes(5));
        }

        if (isset($update['message'])) {
            $message = $update['message'];
            $chatId = $message['chat']['id'];
            $type = isset($message['text']) ? 'message' : 'other';

            if ($type === 'message') {
                \Log::info('Telegram mensaje', [
                    'chat_id' => $chatId,
                    'text' => $message['text'],
                    'from' => $message['from']['username'] ?? $message['from']['first_name'] ?? 'unknown',
                ]);
                $this->bot->handleUpdate($chatId, 'message', $update);
            }
        }

        if (isset($update['callback_query'])) {
            $callbackQuery = $update['callback_query'];
            $chatId = $callbackQuery['message']['chat']['id'];

            \Log::info('Telegram callback', [
                'chat_id' => $chatId,
                'data' => $callbackQuery['data'] ?? '',
                'from' => $callbackQuery['from']['username'] ?? $callbackQuery['from']['first_name'] ?? 'unknown',
            ]);

            $this->bot->handleUpdate($chatId, 'callback_query', $update);
        }

        return response()->json(['status' => 'ok']);
    }
}
