<?php

namespace App\Infrastructure\EstadosProyecto\Repositories;

use App\Application\EstadosProyecto\DTOs\EstadoProyectoDTO;
use App\Domain\EstadosProyecto\Contracts\EstadoProyectoRepositoryInterface;
use App\Infrastructure\EstadosProyecto\Models\EstadoProyecto;

class EloquentEstadoProyectoRepository implements EstadoProyectoRepositoryInterface
{
    public function all(): array
    {
        return EstadoProyecto::orderBy('nombre')
            ->get()
            ->map(fn ($m) => EstadoProyectoDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): EstadoProyectoDTO
    {
        $model = EstadoProyecto::find($id);
        if (! $model) {
            throw new \RuntimeException("Estado de proyecto '{$id}' no encontrado.", 404);
        }

        return EstadoProyectoDTO::fromModel($model);
    }

    public function create(array $data): EstadoProyectoDTO
    {
        $model = EstadoProyecto::create($data);

        return EstadoProyectoDTO::fromModel($model);
    }

    public function update(int $id, array $data): EstadoProyectoDTO
    {
        /** @var EstadoProyecto $model */
        $model = EstadoProyecto::find($id);
        if (! $model) {
            throw new \RuntimeException("Estado de proyecto '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return EstadoProyectoDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return EstadoProyecto::destroy($ids) > 0;
    }
}
