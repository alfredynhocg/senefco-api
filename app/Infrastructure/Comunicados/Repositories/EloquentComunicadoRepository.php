<?php

namespace App\Infrastructure\Comunicados\Repositories;

use App\Application\Comunicados\DTOs\ComunicadoDTO;
use App\Domain\Comunicados\Contracts\ComunicadoRepositoryInterface;
use App\Domain\Comunicados\Exceptions\ComunicadoNotFoundException;
use App\Infrastructure\Comunicados\Models\Comunicado;

class EloquentComunicadoRepository implements ComunicadoRepositoryInterface
{
    public function paginate(array $filters = []): array
    {
        $pageIndex = (int) ($filters['pageIndex'] ?? 1);
        $pageSize = (int) ($filters['pageSize'] ?? 10);
        $query = $filters['query'] ?? '';
        $estado = $filters['estado'] ?? '';

        $q = Comunicado::query();

        if ($query) {
            $q->where(function ($builder) use ($query) {
                $builder->where('titulo', 'like', "%{$query}%")
                    ->orWhere('resumen', 'like', "%{$query}%");
            });
        }

        if ($estado) {
            $q->where('estado', $estado);
        }

        if (! empty($filters['soloActivos'])) {
            $q->where('estado', 'publicado');
        }

        $paginated = $q->orderBy('created_at', 'desc')
            ->paginate($pageSize, ['*'], 'page', $pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => ComunicadoDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): mixed
    {
        $model = Comunicado::find($id);
        if (! $model) {
            throw new ComunicadoNotFoundException($id);
        }

        return $model;
    }

    public function findBySlug(string $slug): mixed
    {
        $model = Comunicado::where('slug', $slug)->first();
        if (! $model) {
            throw new ComunicadoNotFoundException($slug);
        }

        return $model;
    }

    public function create(array $data): mixed
    {
        return Comunicado::create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $model = $this->findById($id);
        $model->update($data);

        return $model->fresh();
    }

    public function delete(int $id): bool
    {
        $model = Comunicado::find($id);
        if (! $model) {
            throw new ComunicadoNotFoundException($id);
        }

        return (bool) $model->delete();
    }
}
