<?php

namespace App\Http\Controllers\Api;

use App\Application\EjesPeiPortal\DTOs\EjePeiPortalDTO;
use App\Http\Controllers\Controller;
use App\Infrastructure\EjesPeiPortal\Models\EjePeiPortal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EjesPeiPortalController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = EjePeiPortal::query();

        if ($search = $request->get('query')) {
            $q->where('nombre', 'like', "%{$search}%");
        }
        if ($request->boolean('soloActivos', false)) {
            $q->where('activo', true);
        } elseif ($request->has('activo') && $request->get('activo') !== '') {
            $q->where('activo', filter_var($request->get('activo'), FILTER_VALIDATE_BOOLEAN));
        }

        $pageSize = (int) $request->get('pageSize', 15);
        $pageIndex = (int) $request->get('pageIndex', 1);

        $paginated = $q->orderBy('orden')->orderBy('created_at', 'desc')
            ->paginate($pageSize, ['*'], 'page', $pageIndex);

        return response()->json([
            'data' => collect($paginated->items())->map(fn ($m) => EjePeiPortalDTO::fromModel($m)),
            'total' => $paginated->total(),
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $model = EjePeiPortal::findOrFail($id);

        return response()->json(EjePeiPortalDTO::fromModel($model));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string'],
            'color' => ['nullable', 'string', 'max:50'],
            'imagen_url' => ['nullable', 'string', 'max:500'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $model = EjePeiPortal::create($data);

        return response()->json(EjePeiPortalDTO::fromModel($model), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $model = EjePeiPortal::findOrFail($id);

        $data = $request->validate([
            'nombre' => ['sometimes', 'required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string'],
            'color' => ['nullable', 'string', 'max:50'],
            'imagen_url' => ['nullable', 'string', 'max:500'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $model->update($data);

        return response()->json(EjePeiPortalDTO::fromModel($model->fresh()));
    }

    public function destroy(int $id): JsonResponse
    {
        EjePeiPortal::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
