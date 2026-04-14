<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\EscalaSalarialPortal\Models\EscalaSalarialPortal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EscalaSalarialPortalController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = EscalaSalarialPortal::query();

        if ($search = $request->get('query')) {
            $q->where(function ($sub) use ($search) {
                $sub->where('cargo', 'like', "%{$search}%")
                    ->orWhere('secretaria', 'like', "%{$search}%")
                    ->orWhere('nivel', 'like', "%{$search}%");
            });
        }
        if ($anio = $request->get('anio')) {
            $q->where('anio', (int) $anio);
        }
        if ($request->has('publicado') && $request->get('publicado') !== '') {
            $q->where('publicado', filter_var($request->get('publicado'), FILTER_VALIDATE_BOOLEAN));
        }

        $pageSize = (int) $request->get('pageSize', 15);
        $pageIndex = (int) $request->get('pageIndex', 1);

        $paginated = $q->orderBy('anio', 'desc')->orderBy('secretaria')->orderBy('cargo')
            ->paginate($pageSize, ['*'], 'page', $pageIndex);

        return response()->json([
            'data' => $paginated->items(),
            'total' => $paginated->total(),
        ]);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(EscalaSalarialPortal::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'anio' => ['required', 'integer'],
            'secretaria' => ['nullable', 'string', 'max:200'],
            'cargo' => ['required', 'string', 'max:200'],
            'nivel' => ['nullable', 'string', 'max:100'],
            'categoria' => ['nullable', 'string', 'max:100'],
            'salario_basico' => ['required', 'numeric', 'min:0'],
            'bono_antiguedad' => ['nullable', 'numeric', 'min:0'],
            'bono_produccion' => ['nullable', 'numeric', 'min:0'],
            'otros_bonos' => ['nullable', 'numeric', 'min:0'],
            'publicado' => ['nullable', 'boolean'],
        ]);

        $model = EscalaSalarialPortal::create($data);

        return response()->json($model, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $model = EscalaSalarialPortal::findOrFail($id);

        $data = $request->validate([
            'anio' => ['sometimes', 'required', 'integer'],
            'secretaria' => ['nullable', 'string', 'max:200'],
            'cargo' => ['sometimes', 'required', 'string', 'max:200'],
            'nivel' => ['nullable', 'string', 'max:100'],
            'categoria' => ['nullable', 'string', 'max:100'],
            'salario_basico' => ['sometimes', 'required', 'numeric', 'min:0'],
            'bono_antiguedad' => ['nullable', 'numeric', 'min:0'],
            'bono_produccion' => ['nullable', 'numeric', 'min:0'],
            'otros_bonos' => ['nullable', 'numeric', 'min:0'],
            'publicado' => ['nullable', 'boolean'],
        ]);

        $model->update($data);

        return response()->json($model->fresh());
    }

    public function destroy(int $id): JsonResponse
    {
        EscalaSalarialPortal::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
