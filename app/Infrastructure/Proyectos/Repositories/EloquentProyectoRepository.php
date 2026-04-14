<?php

namespace App\Infrastructure\Proyectos\Repositories;

use App\Application\Proyectos\DTOs\ProyectoDTO;
use App\Domain\Proyectos\Contracts\ProyectoRepositoryInterface;
use App\Infrastructure\Proyectos\Models\Proyecto;

class EloquentProyectoRepository implements ProyectoRepositoryInterface
{
    public function all(array $filters = []): array
    {
        $q = Proyecto::with(['estado', 'secretaria', 'ultimoAvance']);

        if (! empty($filters['estado_id'])) {
            $q->where('estado_id', $filters['estado_id']);
        }

        if (! empty($filters['secretaria_id'])) {
            $q->where('secretaria_id', $filters['secretaria_id']);
        }

        if (isset($filters['publico'])) {
            $q->where('publico', $filters['publico']);
        }

        return $q->orderBy('created_at', 'desc')
            ->get()
            ->map(fn ($m) => ProyectoDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): ProyectoDTO
    {
        $model = Proyecto::with(['estado', 'secretaria', 'ultimoAvance'])->find($id);
        if (! $model) {
            throw new \RuntimeException("Proyecto '{$id}' no encontrado.", 404);
        }

        return ProyectoDTO::fromModel($model);
    }

    public function findBySlug(string $slug): ProyectoDTO
    {
        $model = Proyecto::with(['estado', 'secretaria', 'ultimoAvance'])->where('slug', $slug)->first();
        if (! $model) {
            throw new \RuntimeException("Proyecto '{$slug}' no encontrado.", 404);
        }

        return ProyectoDTO::fromModel($model);
    }

    public function create(array $data): ProyectoDTO
    {
        $model = Proyecto::create($data);

        return ProyectoDTO::fromModel($model->load(['estado', 'secretaria']));
    }

    public function update(int $id, array $data): ProyectoDTO
    {
        /** @var Proyecto $model */
        $model = Proyecto::find($id);
        if (! $model) {
            throw new \RuntimeException("Proyecto '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return ProyectoDTO::fromModel($model->load(['estado', 'secretaria', 'ultimoAvance']));
    }

    public function delete(int|array $ids): bool
    {
        return Proyecto::destroy($ids) > 0;
    }
}
