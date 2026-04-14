<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndicadorGestionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = DB::table('indicadores_gestion_portal');

        if ($search = $request->get('query')) {
            $q->where(function ($sub) use ($search) {
                $sub->where('nombre', 'like', "%{$search}%")
                    ->orWhere('responsable', 'like', "%{$search}%");
            });
        }
        if ($categoria = $request->get('categoria')) {
            $q->where('categoria', $categoria);
        }
        if ($estado = $request->get('estado')) {
            $q->where('estado', $estado);
        }

        $pageSize = (int) $request->get('pageSize', 15);
        $pageIndex = (int) $request->get('pageIndex', 1);
        $offset = ($pageIndex - 1) * $pageSize;

        $total = $q->count();
        $items = (clone $q)->orderBy('created_at', 'desc')->offset($offset)->limit($pageSize)->get();

        return response()->json(['data' => $items, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $model = DB::table('indicadores_gestion_portal')->where('id', $id)->first();
        if (! $model) {
            abort(404);
        }

        return response()->json($model);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'categoria' => ['required', 'in:social,economico,infraestructura,salud,educacion,medioambiente,seguridad,otro'],
            'unidad' => ['required', 'string', 'max:100'],
            'meta' => ['nullable', 'numeric'],
            'valor_actual' => ['nullable', 'numeric'],
            'periodo' => ['nullable', 'string', 'max:100'],
            'fecha_medicion' => ['nullable', 'date'],
            'estado' => ['nullable', 'in:en_meta,por_encima,por_debajo,sin_dato'],
            'responsable' => ['nullable', 'string', 'max:200'],
            'publicado' => ['nullable', 'boolean'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $now = now()->toDateTimeString();
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        $id = DB::table('indicadores_gestion_portal')->insertGetId($data);

        return response()->json(DB::table('indicadores_gestion_portal')->where('id', $id)->first(), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (! DB::table('indicadores_gestion_portal')->where('id', $id)->exists()) {
            abort(404);
        }

        $data = $request->validate([
            'nombre' => ['sometimes', 'required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'categoria' => ['sometimes', 'required', 'in:social,economico,infraestructura,salud,educacion,medioambiente,seguridad,otro'],
            'unidad' => ['sometimes', 'required', 'string', 'max:100'],
            'meta' => ['nullable', 'numeric'],
            'valor_actual' => ['nullable', 'numeric'],
            'periodo' => ['nullable', 'string', 'max:100'],
            'fecha_medicion' => ['nullable', 'date'],
            'estado' => ['nullable', 'in:en_meta,por_encima,por_debajo,sin_dato'],
            'responsable' => ['nullable', 'string', 'max:200'],
            'publicado' => ['nullable', 'boolean'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $data['updated_at'] = now()->toDateTimeString();
        DB::table('indicadores_gestion_portal')->where('id', $id)->update($data);

        return response()->json(DB::table('indicadores_gestion_portal')->where('id', $id)->first());
    }

    public function destroy(int $id): JsonResponse
    {
        if (! DB::table('indicadores_gestion_portal')->where('id', $id)->delete()) {
            abort(404);
        }

        return response()->json(null, 204);
    }
}
