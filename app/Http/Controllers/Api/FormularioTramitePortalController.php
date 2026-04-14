<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormularioTramitePortalController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = DB::table('formularios_tramite_portal');

        if ($search = $request->get('query')) {
            $q->where(function ($sub) use ($search) {
                $sub->where('titulo', 'like', "%{$search}%")
                    ->orWhere('tramite_nombre', 'like', "%{$search}%");
            });
        }
        if ($tramiteId = $request->get('tramite_id')) {
            $q->where('tramite_id', (int) $tramiteId);
        }
        if ($request->has('vigente') && $request->get('vigente') !== '') {
            $q->where('vigente', filter_var($request->get('vigente'), FILTER_VALIDATE_BOOLEAN));
        }

        $pageSize = (int) $request->get('pageSize', 15);
        $pageIndex = (int) $request->get('pageIndex', 1);
        $offset = ($pageIndex - 1) * $pageSize;

        $total = $q->count();
        $items = (clone $q)->orderBy('orden')->orderBy('titulo')->offset($offset)->limit($pageSize)->get();

        return response()->json([
            'data' => $items,
            'total' => $total,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $model = DB::table('formularios_tramite_portal')->where('id', $id)->first();
        if (! $model) {
            abort(404);
        }

        return response()->json($model);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'tramite_id' => ['nullable', 'integer'],
            'tramite_nombre' => ['nullable', 'string', 'max:300'],
            'titulo' => ['required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'version' => ['nullable', 'string', 'max:50'],
            'archivo_url' => ['required', 'string', 'max:500'],
            'archivo_nombre' => ['nullable', 'string', 'max:255'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'vigente' => ['nullable', 'boolean'],
            'publicado' => ['nullable', 'boolean'],
        ]);

        $now = now()->toDateTimeString();
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        $id = DB::table('formularios_tramite_portal')->insertGetId($data);

        return response()->json(DB::table('formularios_tramite_portal')->where('id', $id)->first(), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (! DB::table('formularios_tramite_portal')->where('id', $id)->exists()) {
            abort(404);
        }

        $data = $request->validate([
            'tramite_id' => ['nullable', 'integer'],
            'tramite_nombre' => ['nullable', 'string', 'max:300'],
            'titulo' => ['sometimes', 'required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'version' => ['nullable', 'string', 'max:50'],
            'archivo_url' => ['sometimes', 'required', 'string', 'max:500'],
            'archivo_nombre' => ['nullable', 'string', 'max:255'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'vigente' => ['nullable', 'boolean'],
            'publicado' => ['nullable', 'boolean'],
        ]);

        $data['updated_at'] = now()->toDateTimeString();
        DB::table('formularios_tramite_portal')->where('id', $id)->update($data);

        return response()->json(DB::table('formularios_tramite_portal')->where('id', $id)->first());
    }

    public function destroy(int $id): JsonResponse
    {
        if (! DB::table('formularios_tramite_portal')->where('id', $id)->delete()) {
            abort(404);
        }

        return response()->json(null, 204);
    }
}
