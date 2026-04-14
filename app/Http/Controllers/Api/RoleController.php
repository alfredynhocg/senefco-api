<?php

namespace App\Http\Controllers\Api;

use App\Domain\Usuarios\Contracts\RoleRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(
        private readonly RoleRepositoryInterface $repository
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->repository->all());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->repository->findById($id));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100|unique:roles,nombre',
            'descripcion' => 'nullable|string|max:255',
            'permisos' => 'nullable|array',
            'permisos.*' => 'string',
            'activo' => 'boolean',
        ]);

        $data['activo'] = $data['activo'] ?? true;
        $data['permisos'] = $data['permisos'] ?? [];

        return response()->json($this->repository->create($data), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'nombre' => "required|string|max:100|unique:roles,nombre,{$id}",
            'descripcion' => 'nullable|string|max:255',
            'permisos' => 'nullable|array',
            'permisos.*' => 'string',
            'activo' => 'boolean',
        ]);

        $data['permisos'] = $data['permisos'] ?? [];

        return response()->json($this->repository->update($id, $data));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->repository->delete($id);

        return response()->json(null, 204);
    }
}
