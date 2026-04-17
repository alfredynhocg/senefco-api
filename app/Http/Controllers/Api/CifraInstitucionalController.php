<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CifraInstitucionalController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = DB::table('web_cifra_institucional');

        if ($search = $request->get('query')) {
            $q->where(function ($sub) use ($search) {
                $sub->where('etiqueta', 'like', "%{$search}%")
                    ->orWhere('valor', 'like', "%{$search}%");
            });
        }

        $pageSize = (int) $request->get('pageSize', 15);
        $pageIndex = (int) $request->get('pageIndex', 1);
        $offset = ($pageIndex - 1) * $pageSize;

        $total = $q->count();
        $items = (clone $q)->orderBy('orden', 'asc')->offset($offset)->limit($pageSize)->get();

        return response()->json(['data' => $items, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $item = DB::table('web_cifra_institucional')->where('id', $id)->first();
        if (! $item) {
            abort(404);
        }

        return response()->json($item);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'valor' => ['required', 'string', 'max:50'],
            'etiqueta' => ['required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string', 'max:300'],
            'icono' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:7'],
            'orden' => ['nullable', 'integer'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $data['activo'] = $data['activo'] ?? true;
        $data['orden'] = $data['orden'] ?? 0;
        $data['created_at'] = now()->toDateTimeString();
        $data['updated_at'] = now()->toDateTimeString();

        $id = DB::table('web_cifra_institucional')->insertGetId($data);

        return response()->json(DB::table('web_cifra_institucional')->where('id', $id)->first(), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (! DB::table('web_cifra_institucional')->where('id', $id)->exists()) {
            abort(404);
        }

        $data = $request->validate([
            'valor' => ['sometimes', 'required', 'string', 'max:50'],
            'etiqueta' => ['sometimes', 'required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string', 'max:300'],
            'icono' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:7'],
            'orden' => ['nullable', 'integer'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $data['updated_at'] = now()->toDateTimeString();
        DB::table('web_cifra_institucional')->where('id', $id)->update($data);

        return response()->json(DB::table('web_cifra_institucional')->where('id', $id)->first());
    }

    public function destroy(int $id): JsonResponse
    {
        if (! DB::table('web_cifra_institucional')->where('id', $id)->delete()) {
            abort(404);
        }

        return response()->json(null, 204);
    }
}
