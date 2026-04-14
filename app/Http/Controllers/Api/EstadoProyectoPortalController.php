<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadoProyectoPortalController extends Controller
{
    private function query(): Builder
    {
        return DB::table('estados_proyecto_portal')->toBase()
            ->selectRaw('*');
    }

    public function index(Request $request): JsonResponse
    {
        $q = DB::table('estados_proyecto_portal');

        if ($search = $request->get('query')) {
            $q->where(function ($sub) use ($search) {
                $sub->where('nombre', 'like', "%{$search}%")
                    ->orWhere('secretaria', 'like', "%{$search}%")
                    ->orWhere('ubicacion', 'like', "%{$search}%");
            });
        }
        if ($estado = $request->get('estado')) {
            $q->where('estado', $estado);
        }
        if ($request->has('publicado') && $request->get('publicado') !== '') {
            $q->where('publicado', filter_var($request->get('publicado'), FILTER_VALIDATE_BOOLEAN));
        }

        $pageSize = (int) $request->get('pageSize', 15);
        $pageIndex = (int) $request->get('pageIndex', 1);
        $offset = ($pageIndex - 1) * $pageSize;

        $total = $q->count();
        $items = (clone $q)->orderBy('created_at', 'desc')->offset($offset)->limit($pageSize)->get();

        return response()->json([
            'data' => $items,
            'total' => $total,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $model = DB::table('estados_proyecto_portal')->where('id', $id)->first();
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
            'secretaria' => ['nullable', 'string', 'max:200'],
            'categoria' => ['nullable', 'string', 'max:100'],
            'ubicacion' => ['nullable', 'string', 'max:255'],
            'presupuesto' => ['nullable', 'numeric', 'min:0'],
            'estado' => ['nullable', 'in:planificacion,en_ejecucion,paralizado,concluido,cancelado'],
            'porcentaje_avance' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin_estimada' => ['nullable', 'date'],
            'fecha_fin_real' => ['nullable', 'date'],
            'imagen_url' => ['nullable', 'string', 'max:500'],
            'publicado' => ['nullable', 'boolean'],
        ]);

        $now = now()->toDateTimeString();
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        $id = DB::table('estados_proyecto_portal')->insertGetId($data);
        $model = DB::table('estados_proyecto_portal')->where('id', $id)->first();

        return response()->json($model, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $exists = DB::table('estados_proyecto_portal')->where('id', $id)->exists();
        if (! $exists) {
            abort(404);
        }

        $data = $request->validate([
            'nombre' => ['sometimes', 'required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'secretaria' => ['nullable', 'string', 'max:200'],
            'categoria' => ['nullable', 'string', 'max:100'],
            'ubicacion' => ['nullable', 'string', 'max:255'],
            'presupuesto' => ['nullable', 'numeric', 'min:0'],
            'estado' => ['nullable', 'in:planificacion,en_ejecucion,paralizado,concluido,cancelado'],
            'porcentaje_avance' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin_estimada' => ['nullable', 'date'],
            'fecha_fin_real' => ['nullable', 'date'],
            'imagen_url' => ['nullable', 'string', 'max:500'],
            'publicado' => ['nullable', 'boolean'],
        ]);

        $data['updated_at'] = now()->toDateTimeString();
        DB::table('estados_proyecto_portal')->where('id', $id)->update($data);

        return response()->json(DB::table('estados_proyecto_portal')->where('id', $id)->first());
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = DB::table('estados_proyecto_portal')->where('id', $id)->delete();
        if (! $deleted) {
            abort(404);
        }

        return response()->json(null, 204);
    }
}
