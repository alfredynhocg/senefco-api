<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigSitioController extends Controller
{
    public function show(): JsonResponse
    {
        $config = DB::table('config_sitio')->first();
        if (! $config) {
            abort(404);
        }

        return response()->json($config);
    }

    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['sometimes', 'required', 'string', 'max:300'],
            'slogan' => ['nullable', 'string', 'max:500'],
            'descripcion' => ['nullable', 'string'],
            'logo_url' => ['nullable', 'string', 'max:500'],
            'favicon_url' => ['nullable', 'string', 'max:500'],
            'email_contacto' => ['nullable', 'email', 'max:200'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'direccion' => ['nullable', 'string', 'max:300'],
            'ciudad' => ['nullable', 'string', 'max:100'],
            'pais' => ['nullable', 'string', 'max:100'],
            'latitud' => ['nullable', 'numeric'],
            'longitud' => ['nullable', 'numeric'],
            'horario_atencion' => ['nullable', 'string', 'max:300'],
            'meta_titulo' => ['nullable', 'string', 'max:300'],
            'meta_descripcion' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'google_analytics_id' => ['nullable', 'string', 'max:100'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $data['updated_at'] = now()->toDateTimeString();
        DB::table('config_sitio')->where('id', 1)->update($data);

        return response()->json(DB::table('config_sitio')->first());
    }
}
