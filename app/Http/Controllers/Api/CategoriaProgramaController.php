<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriaProgramaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = DB::table('web_categoria_programa');

        if ($search = $request->get('query')) {
            $q->where('nombre', 'like', "%{$search}%");
        }

        $pageSize = (int) $request->get('pageSize', 100);
        $pageIndex = (int) $request->get('pageIndex', 1);
        $offset = ($pageIndex - 1) * $pageSize;

        $total = $q->count();
        $items = (clone $q)
            ->where('activo', true)
            ->orderBy('orden', 'asc')
            ->orderBy('nombre', 'asc')
            ->offset($offset)
            ->limit($pageSize)
            ->get();

        return response()->json(['data' => $items, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $model = DB::table('web_categoria_programa')->where('id', $id)->first();
        if (! $model) {
            abort(404);
        }

        return response()->json($model);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200', 'unique:web_categoria_programa,slug'],
            'descripcion' => ['nullable', 'string'],
            'icono' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:7'],
            'orden' => ['nullable', 'integer'],
            'activo' => ['nullable', 'boolean'],
            'meta_titulo' => ['nullable', 'string', 'max:300'],
            'meta_descripcion' => ['nullable', 'string', 'max:500'],
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['nombre']);
        }

        $data['activo'] = $data['activo'] ?? true;
        $data['orden'] = $data['orden'] ?? 0;
        $data['created_at'] = now()->toDateTimeString();
        $data['updated_at'] = now()->toDateTimeString();

        $id = DB::table('web_categoria_programa')->insertGetId($data);

        return response()->json(DB::table('web_categoria_programa')->where('id', $id)->first(), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (! DB::table('web_categoria_programa')->where('id', $id)->exists()) {
            abort(404);
        }

        $data = $request->validate([
            'nombre' => ['sometimes', 'required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string'],
            'icono' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:7'],
            'orden' => ['nullable', 'integer'],
            'activo' => ['nullable', 'boolean'],
            'meta_titulo' => ['nullable', 'string', 'max:300'],
            'meta_descripcion' => ['nullable', 'string', 'max:500'],
        ]);

        $data['updated_at'] = now()->toDateTimeString();
        DB::table('web_categoria_programa')->where('id', $id)->update($data);

        return response()->json(DB::table('web_categoria_programa')->where('id', $id)->first());
    }

    public function destroy(int $id): JsonResponse
    {
        if (! DB::table('web_categoria_programa')->where('id', $id)->delete()) {
            abort(404);
        }

        return response()->json(null, 204);
    }
}
