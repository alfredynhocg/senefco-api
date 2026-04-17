<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GaleriaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = $request->get('query', '');
        $size = (int) $request->get('pageSize', 20);
        $page = (int) $request->get('pageIndex', 1);

        $soloActivos = $request->boolean('soloActivos', false);

        $q = DB::table('galerias');
        if ($soloActivos) {
            $q->where('activo', true);
        }
        if ($query) {
            $q->where('titulo', 'like', "%{$query}%");
        }

        $total = $q->count();
        $data = $q->orderBy('galerias.orden')->orderByDesc('galerias.id')
            ->offset(($page - 1) * $size)->limit($size)->get();

        $ids = $data->pluck('id');
        $counts = DB::table('galeria_items')
            ->whereIn('galeria_id', $ids)
            ->selectRaw('galeria_id, count(*) as total')
            ->groupBy('galeria_id')
            ->pluck('total', 'galeria_id');

        $data = $data->map(function ($g) use ($counts) {
            $g->items_count = (int) ($counts[$g->id] ?? 0);

            return $g;
        });

        return response()->json(['data' => $data, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $galeria = DB::table('galerias')->find($id);
        if (! $galeria) {
            abort(404, 'Galería no encontrada');
        }

        return response()->json($galeria);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'portada_url' => ['nullable', 'string', 'max:500'],
            'tipo' => ['nullable', 'in:fotos,videos,mixto'],
            'orden' => ['nullable', 'integer'],
            'activo' => ['nullable', 'boolean'],
        ]);
        $data['activo'] = $request->boolean('activo', true);
        $data['tipo'] = $data['tipo'] ?? 'fotos';
        $data['orden'] = $request->integer('orden', 0);

        $id = DB::table('galerias')->insertGetId($data);
        $galeria = DB::table('galerias')->find($id);

        return response()->json($galeria, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $galeria = DB::table('galerias')->find($id);
        if (! $galeria) {
            abort(404, 'Galería no encontrada');
        }

        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'portada_url' => ['nullable', 'string', 'max:500'],
            'tipo' => ['nullable', 'in:fotos,videos,mixto'],
            'orden' => ['nullable', 'integer'],
            'activo' => ['nullable', 'boolean'],
        ]);
        $data['activo'] = $request->boolean('activo', true);
        $data['tipo'] = $data['tipo'] ?? 'fotos';
        $data['orden'] = $request->integer('orden', 0);

        DB::table('galerias')->where('id', $id)->update($data);

        return response()->json(DB::table('galerias')->find($id));
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = DB::table('galerias')->where('id', $id)->delete();
        if (! $deleted) {
            abort(404, 'Galería no encontrada');
        }

        return response()->json(null, 204);
    }
}
