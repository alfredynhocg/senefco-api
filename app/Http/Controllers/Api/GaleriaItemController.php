<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GaleriaItemController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $galeriaId = $request->get('galeria_id');
        $soloActivos = $request->boolean('soloActivos', false);
        $size = (int) $request->get('pageSize', 50);
        $page = (int) $request->get('pageIndex', 1);

        $q = DB::table('galeria_items')
            ->join('galerias', 'galeria_items.galeria_id', '=', 'galerias.id')
            ->select('galeria_items.*');

        if ($soloActivos) {
            $q->where('galerias.activo', true);
        }

        if ($galeriaId) {
            $q->where('galeria_items.galeria_id', $galeriaId);
        }

        $total = $q->count();
        $data = $q->orderBy('galeria_items.orden')->orderBy('galeria_items.id')
            ->offset(($page - 1) * $size)->limit($size)->get();

        return response()->json(['data' => $data, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $item = DB::table('galeria_items')->find($id);
        if (! $item) {
            abort(404, 'Item no encontrado');
        }

        return response()->json($item);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'galeria_id' => ['required', 'integer', 'exists:galerias,id'],
            'tipo' => ['nullable', 'in:foto,video'],
            'url' => ['required', 'string', 'max:500'],
            'thumbnail_url' => ['nullable', 'string', 'max:500'],
            'titulo' => ['nullable', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'orden' => ['nullable', 'integer'],
        ]);
        $data['tipo'] = $data['tipo'] ?? 'foto';
        $data['orden'] = $request->integer('orden', 0);

        $id = DB::table('galeria_items')->insertGetId($data);
        $item = DB::table('galeria_items')->find($id);

        return response()->json($item, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = DB::table('galeria_items')->find($id);
        if (! $item) {
            abort(404, 'Item no encontrado');
        }

        $data = $request->validate([
            'galeria_id' => ['required', 'integer', 'exists:galerias,id'],
            'tipo' => ['nullable', 'in:foto,video'],
            'url' => ['required', 'string', 'max:500'],
            'thumbnail_url' => ['nullable', 'string', 'max:500'],
            'titulo' => ['nullable', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'orden' => ['nullable', 'integer'],
        ]);
        $data['tipo'] = $data['tipo'] ?? 'foto';
        $data['orden'] = $request->integer('orden', 0);

        DB::table('galeria_items')->where('id', $id)->update($data);

        return response()->json(DB::table('galeria_items')->find($id));
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = DB::table('galeria_items')->where('id', $id)->delete();
        if (! $deleted) {
            abort(404, 'Item no encontrado');
        }

        return response()->json(null, 204);
    }
}
