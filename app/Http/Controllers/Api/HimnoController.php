<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HimnoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = DB::table('himnos');

        if ($search = $request->get('query')) {
            $q->where(function ($sub) use ($search) {
                $sub->where('titulo', 'like', "%{$search}%")
                    ->orWhere('autor_letra', 'like', "%{$search}%")
                    ->orWhere('autor_musica', 'like', "%{$search}%");
            });
        }
        if ($tipo = $request->get('tipo')) {
            $q->where('tipo', $tipo);
        }

        $pageSize = (int) $request->get('pageSize', 15);
        $pageIndex = (int) $request->get('pageIndex', 1);
        $offset = ($pageIndex - 1) * $pageSize;

        $total = $q->count();
        $items = (clone $q)->orderBy('orden')->orderBy('tipo')->offset($offset)->limit($pageSize)->get();

        return response()->json(['data' => $items, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $model = DB::table('himnos')->where('id', $id)->first();
        if (! $model) {
            abort(404);
        }

        return response()->json($model);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'tipo' => ['required', 'in:municipal,departamental,nacional,otro'],
            'titulo' => ['required', 'string', 'max:300'],
            'letra' => ['nullable', 'string'],
            'autor_letra' => ['nullable', 'string', 'max:200'],
            'autor_musica' => ['nullable', 'string', 'max:200'],
            'audio_url' => ['nullable', 'string', 'max:500'],
            'partitura_url' => ['nullable', 'string', 'max:500'],
            'imagen_url' => ['nullable', 'string', 'max:500'],
            'descripcion' => ['nullable', 'string'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $now = now()->toDateTimeString();
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        $id = DB::table('himnos')->insertGetId($data);

        return response()->json(DB::table('himnos')->where('id', $id)->first(), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (! DB::table('himnos')->where('id', $id)->exists()) {
            abort(404);
        }

        $data = $request->validate([
            'tipo' => ['sometimes', 'required', 'in:municipal,departamental,nacional,otro'],
            'titulo' => ['sometimes', 'required', 'string', 'max:300'],
            'letra' => ['nullable', 'string'],
            'autor_letra' => ['nullable', 'string', 'max:200'],
            'autor_musica' => ['nullable', 'string', 'max:200'],
            'audio_url' => ['nullable', 'string', 'max:500'],
            'partitura_url' => ['nullable', 'string', 'max:500'],
            'imagen_url' => ['nullable', 'string', 'max:500'],
            'descripcion' => ['nullable', 'string'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $data['updated_at'] = now()->toDateTimeString();
        DB::table('himnos')->where('id', $id)->update($data);

        return response()->json(DB::table('himnos')->where('id', $id)->first());
    }

    public function destroy(int $id): JsonResponse
    {
        if (! DB::table('himnos')->where('id', $id)->delete()) {
            abort(404);
        }

        return response()->json(null, 204);
    }
}
