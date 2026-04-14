<?php

namespace App\Http\Controllers\Api\WhatsApp;

use App\Http\Controllers\Controller;
use App\Http\Traits\WhatsAppServiceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WhatsAppMediaController extends Controller
{
    use WhatsAppServiceTrait;

    public function __construct()
    {
        $this->initializeWhatsAppService();
    }

    /**
     * POST /api/whatsapp/send/document
     * { "to": "591...", "source": "https://... o media_id", "caption": "...", "filename": "doc.pdf" }
     */
    public function document(Request $request): JsonResponse
    {
        $data = $request->validate([
            'to' => 'required|string',
            'source' => 'required|string',
            'caption' => 'string',
            'filename' => 'string',
        ]);

        return response()->json($this->wa->sendDocument($data['to'], $data['source'], $data['caption'] ?? '', $data['filename'] ?? ''));
    }

    /**
     * POST /api/whatsapp/send/audio
     * { "to": "591...", "source": "https://... o media_id" }
     */
    public function audio(Request $request): JsonResponse
    {
        $data = $request->validate(['to' => 'required|string', 'source' => 'required|string']);

        return response()->json($this->wa->sendAudio($data['to'], $data['source']));
    }

    /**
     * POST /api/whatsapp/send/image
     * { "to": "591...", "source": "https://...", "caption": "Mi imagen" }
     */
    public function image(Request $request): JsonResponse
    {
        $data = $request->validate([
            'to' => 'required|string',
            'source' => 'required|string',
            'caption' => 'string',
        ]);

        return response()->json($this->wa->sendImage($data['to'], $data['source'], $data['caption'] ?? ''));
    }

    /**
     * POST /api/whatsapp/send/video
     * { "to": "591...", "source": "https://...", "caption": "Mi video" }
     */
    public function video(Request $request): JsonResponse
    {
        $data = $request->validate([
            'to' => 'required|string',
            'source' => 'required|string',
            'caption' => 'string',
        ]);

        return response()->json($this->wa->sendVideo($data['to'], $data['source'], $data['caption'] ?? ''));
    }

    /**
     * POST /api/whatsapp/send/sticker
     * { "to": "591...", "source": "https://... (.webp)" }
     */
    public function sticker(Request $request): JsonResponse
    {
        $data = $request->validate(['to' => 'required|string', 'source' => 'required|string']);

        return response()->json($this->wa->sendSticker($data['to'], $data['source']));
    }

    /**
     * POST /api/whatsapp/media/upload
     * Form-data: file (archivo a subir)
     */
    public function uploadMedia(Request $request): JsonResponse
    {
        $request->validate(['file' => 'required|file']);
        $path = $request->file('file')->getRealPath();
        $response = $this->wa->uploadMedia($path);

        return response()->json($response);
    }

    /**
     * GET /api/whatsapp/media/{mediaId}
     * Descarga el archivo y lo devuelve como respuesta binaria.
     */
    public function downloadMedia(string $mediaId): \Illuminate\Http\Response
    {
        $content = $this->wa->downloadMedia($mediaId);

        return response($content, 200)->header('Content-Type', 'application/octet-stream');
    }
}
