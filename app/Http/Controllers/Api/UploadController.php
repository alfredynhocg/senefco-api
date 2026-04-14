<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function image(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'image', 'max:20480'], // 20 MB max
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid().'.'.$extension;

        $path = $file->storeAs('uploads/images', $filename, 'public');

        return response()->json([
            'url' => '/storage/'.$path,
        ], 201);
    }

    public function file(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'max:20480', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,mp3,mp4,wav,ogg'],
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid().'.'.$extension;

        $path = $file->storeAs('uploads/files', $filename, 'public');

        return response()->json([
            'url' => '/storage/'.$path,
        ], 201);
    }
}
