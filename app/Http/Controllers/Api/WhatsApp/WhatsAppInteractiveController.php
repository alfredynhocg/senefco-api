<?php

namespace App\Http\Controllers\Api\WhatsApp;

use App\Http\Controllers\Controller;
use App\Http\Traits\WhatsAppServiceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WhatsAppInteractiveController extends Controller
{
    use WhatsAppServiceTrait;

    public function __construct()
    {
        $this->initializeWhatsAppService();
    }

    /**
     * POST /api/whatsapp/send/buttons
     * {
     *   "to": "591...",
     *   "body": "¿Qué necesitas?",
     *   "header": "Menú",
     *   "footer": "Elige una opción",
     *   "buttons": [
     *     { "id": "btn_1", "title": "Opción 1" },
     *     { "id": "btn_2", "title": "Opción 2" }
     *   ]
     * }
     */
    public function buttons(Request $request): JsonResponse
    {
        $data = $request->validate([
            'to' => 'required|string',
            'body' => 'required|string',
            'header' => 'string',
            'footer' => 'string',
            'buttons' => 'required|array|min:1|max:3',
            'buttons.*.id' => 'required|string',
            'buttons.*.title' => 'required|string',
        ]);

        return response()->json($this->wa->sendButtons($data['to'], $data['body'], $data['buttons'], $data['header'] ?? '', $data['footer'] ?? ''));
    }

    /**
     * POST /api/whatsapp/send/list
     * {
     *   "to": "591...",
     *   "header": "Catálogo",
     *   "body": "Elige tu producto",
     *   "footer": "PuntoVentas",
     *   "button_text": "Ver opciones",
     *   "sections": [
     *     {
     *       "title": "Electrónicos",
     *       "rows": [
     *         { "id": "prod_1", "title": "Laptop", "description": "Laptop HP 15'" }
     *       ]
     *     }
     *   ]
     * }
     */
    public function list(Request $request): JsonResponse
    {
        $data = $request->validate([
            'to' => 'required|string',
            'header' => 'required|string',
            'body' => 'required|string',
            'footer' => 'string',
            'button_text' => 'required|string',
            'sections' => 'required|array|min:1',
            'sections.*.title' => 'required|string',
            'sections.*.rows' => 'required|array|min:1',
            'sections.*.rows.*.id' => 'required|string',
            'sections.*.rows.*.title' => 'required|string',
            'sections.*.rows.*.description' => 'string',
        ]);

        return response()->json($this->wa->sendList($data['to'], $data['header'], $data['body'], $data['footer'] ?? '', $data['button_text'], $data['sections']));
    }
}
