<?php

namespace App\Http\Controllers\Api\WhatsApp;

use App\Http\Controllers\Controller;
use App\Http\Traits\WhatsAppServiceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WhatsAppLocationController extends Controller
{
    use WhatsAppServiceTrait;

    public function __construct()
    {
        $this->initializeWhatsAppService();
    }

    /**
     * POST /api/whatsapp/send/location
     * { "to": "591...", "lat": -17.38, "lng": -66.15, "name": "Tienda", "address": "Av. X" }
     */
    public function location(Request $request): JsonResponse
    {
        $data = $request->validate([
            'to' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'name' => 'string',
            'address' => 'string',
        ]);

        return response()->json($this->wa->sendLocation($data['to'], $data['lat'], $data['lng'], $data['name'] ?? '', $data['address'] ?? ''));
    }

    /**
     * POST /api/whatsapp/send/location-request
     * { "to": "591...", "body": "¿Dónde te encuentras?" }
     */
    public function locationRequest(Request $request): JsonResponse
    {
        $data = $request->validate(['to' => 'required|string', 'body' => 'string']);

        return response()->json($this->wa->sendLocationRequest($data['to'], $data['body'] ?? '¿Dónde te encuentras?'));
    }
}
