<?php

namespace App\Http\Controllers\Api\WhatsApp;

use App\Http\Controllers\Controller;
use App\Http\Traits\WhatsAppServiceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WhatsAppMessageController extends Controller
{
    use WhatsAppServiceTrait;

    public function __construct()
    {
        $this->initializeWhatsAppService();
    }

    /**
     * POST /api/whatsapp/send/text
     * { "to": "591...", "message": "Hola!", "preview_url": false }
     */
    public function text(Request $request): JsonResponse
    {
        $data = $request->validate([
            'to' => 'required|string',
            'message' => 'required|string',
            'preview_url' => 'boolean',
        ]);

        return response()->json($this->wa->sendText($data['to'], $data['message'], $data['preview_url'] ?? false));
    }

    /**
     * POST /api/whatsapp/message/read
     * { "message_id": "wamid.xxx" }
     */
    public function markAsRead(Request $request): JsonResponse
    {
        $data = $request->validate(['message_id' => 'required|string']);

        return response()->json($this->wa->markAsRead($data['message_id']));
    }

    /**
     * POST /api/whatsapp/message/react
     * { "to": "591...", "message_id": "wamid.xxx", "emoji": "👍" }
     */
    public function react(Request $request): JsonResponse
    {
        $data = $request->validate([
            'to' => 'required|string',
            'message_id' => 'required|string',
            'emoji' => 'required|string',
        ]);

        return response()->json($this->wa->reactToMessage($data['to'], $data['message_id'], $data['emoji']));
    }
}
