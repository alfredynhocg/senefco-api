<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpedidoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = DB::table('web_expedido');

        if ($search = $request->get('query')) {
            $q->where('nombre', 'like', "%{$search}%");
        }

        $pageSize = (int) $request->get('pageSize', 50);
        $pageIndex = (int) $request->get('pageIndex', 1);
        $offset = ($pageIndex - 1) * $pageSize;

        $total = $q->count();
        $items = (clone $q)->orderBy('orden', 'asc')->orderBy('nombre', 'asc')->offset($offset)->limit($pageSize)->get();

        return response()->json(['data' => $items, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $item = DB::table('web_expedido')->where('id', $id)->first();
        if (! $item) {
            abort(404);
        }

        return response()->json($item);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'orden' => ['nullable', 'integer'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $data['activo'] = $data['activo'] ?? true;
        $data['orden'] = $data['orden'] ?? 0;
        $data['created_at'] = now()->toDateTimeString();
        $data['updated_at'] = now()->toDateTimeString();

        $id = DB::table('web_expedido')->insertGetId($data);

        return response()->json(DB::table('web_expedido')->where('id', $id)->first(), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (! DB::table('web_expedido')->where('id', $id)->exists()) {
            abort(404);
        }

        $data = $request->validate([
            'nombre' => ['sometimes', 'required', 'string', 'max:150'],
            'orden' => ['nullable', 'integer'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $data['updated_at'] = now()->toDateTimeString();
        DB::table('web_expedido')->where('id', $id)->update($data);

        return response()->json(DB::table('web_expedido')->where('id', $id)->first());
    }

    public function destroy(int $id): JsonResponse
    {
        if (! DB::table('web_expedido')->where('id', $id)->delete()) {
            abort(404);
        }

        return response()->json(null, 204);
    }
}
