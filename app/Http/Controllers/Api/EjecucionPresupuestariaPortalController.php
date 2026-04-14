<?php

namespace App\Http\Controllers\Api;

use App\Application\EjecucionPresupuestariaPortal\DTOs\EjecucionPortalDTO;
use App\Http\Controllers\Controller;
use App\Infrastructure\EjecucionPresupuestariaPortal\Models\EjecucionPortal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EjecucionPresupuestariaPortalController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = EjecucionPortal::query();

        if ($search = $request->get('query')) {
            $q->where(function ($sub) use ($search) {
                $sub->where('unidad_ejecutora', 'like', "%{$search}%")
                    ->orWhere('programa', 'like', "%{$search}%");
            });
        }
        if ($anio = $request->get('anio')) {
            $q->where('anio', (int) $anio);
        }
        if ($periodo = $request->get('periodo')) {
            $q->where('periodo', $periodo);
        }
        if ($request->has('publicado') && $request->get('publicado') !== '') {
            $q->where('publicado', filter_var($request->get('publicado'), FILTER_VALIDATE_BOOLEAN));
        }

        $pageSize = (int) $request->get('pageSize', 15);
        $pageIndex = (int) $request->get('pageIndex', 1);

        $paginated = $q->orderBy('anio', 'desc')->orderBy('created_at', 'desc')
            ->paginate($pageSize, ['*'], 'page', $pageIndex);

        return response()->json([
            'data' => collect($paginated->items())->map(fn ($m) => EjecucionPortalDTO::fromModel($m)),
            'total' => $paginated->total(),
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $model = EjecucionPortal::findOrFail($id);

        return response()->json(EjecucionPortalDTO::fromModel($model));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'anio' => ['required', 'integer'],
            'periodo' => ['required', 'in:mensual,trimestral,semestral,anual'],
            'mes' => ['nullable', 'integer', 'min:1', 'max:12'],
            'trimestre' => ['nullable', 'integer', 'min:1', 'max:4'],
            'semestre' => ['nullable', 'integer', 'min:1', 'max:2'],
            'unidad_ejecutora' => ['required', 'string', 'max:200'],
            'programa' => ['nullable', 'string', 'max:200'],
            'fuente_financiamiento' => ['nullable', 'string', 'max:100'],
            'presupuesto_inicial' => ['required', 'numeric', 'min:0'],
            'presupuesto_vigente' => ['required', 'numeric', 'min:0'],
            'ejecutado' => ['required', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string'],
            'archivo_url' => ['nullable', 'string', 'max:500'],
            'archivo_nombre' => ['nullable', 'string', 'max:255'],
            'publicado' => ['nullable', 'boolean'],
        ]);

        $model = EjecucionPortal::create($data);

        return response()->json(EjecucionPortalDTO::fromModel($model), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $model = EjecucionPortal::findOrFail($id);

        $data = $request->validate([
            'anio' => ['sometimes', 'required', 'integer'],
            'periodo' => ['sometimes', 'required', 'in:mensual,trimestral,semestral,anual'],
            'mes' => ['nullable', 'integer', 'min:1', 'max:12'],
            'trimestre' => ['nullable', 'integer', 'min:1', 'max:4'],
            'semestre' => ['nullable', 'integer', 'min:1', 'max:2'],
            'unidad_ejecutora' => ['sometimes', 'required', 'string', 'max:200'],
            'programa' => ['nullable', 'string', 'max:200'],
            'fuente_financiamiento' => ['nullable', 'string', 'max:100'],
            'presupuesto_inicial' => ['sometimes', 'required', 'numeric', 'min:0'],
            'presupuesto_vigente' => ['sometimes', 'required', 'numeric', 'min:0'],
            'ejecutado' => ['sometimes', 'required', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string'],
            'archivo_url' => ['nullable', 'string', 'max:500'],
            'archivo_nombre' => ['nullable', 'string', 'max:255'],
            'publicado' => ['nullable', 'boolean'],
        ]);

        $model->update($data);

        return response()->json(EjecucionPortalDTO::fromModel($model->fresh()));
    }

    public function destroy(int $id): JsonResponse
    {
        EjecucionPortal::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
