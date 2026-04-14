<?php

namespace App\Infrastructure\DirectorioInstitucional\Repositories;

use App\Application\DirectorioInstitucional\DTOs\DirectorioInstitucionalDTO;
use App\Domain\DirectorioInstitucional\Contracts\DirectorioInstitucionalRepositoryInterface;
use App\Domain\DirectorioInstitucional\Exceptions\DirectorioInstitucionalNotFoundException;
use App\Infrastructure\DirectorioInstitucional\Models\DirectorioInstitucional;

class EloquentDirectorioInstitucionalRepository implements DirectorioInstitucionalRepositoryInterface
{
    public function paginate(int $pageIndex, int $pageSize, string $query, string $activo): array
    {
        $q = DirectorioInstitucional::with('secretaria');

        if ($query) {
            $q->where(function ($sub) use ($query) {
                $sub->where('nombre_unidad', 'like', "%{$query}%")
                    ->orWhere('titular', 'like', "%{$query}%")
                    ->orWhere('email_institucional', 'like', "%{$query}%");
            });
        }

        if ($activo !== '') {
            $q->where('activo', (bool) $activo);
        }

        $paginated = $q->orderBy('orden')->paginate($pageSize, ['*'], 'page', $pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => DirectorioInstitucionalDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): DirectorioInstitucionalDTO
    {
        $model = DirectorioInstitucional::with('secretaria')->find($id);
        if (! $model) {
            throw new DirectorioInstitucionalNotFoundException($id);
        }

        return DirectorioInstitucionalDTO::fromModel($model);
    }

    public function create(array $data): DirectorioInstitucionalDTO
    {
        $model = DirectorioInstitucional::create($data);
        $model->load('secretaria');

        return DirectorioInstitucionalDTO::fromModel($model);
    }

    public function update(int $id, array $data): DirectorioInstitucionalDTO
    {
        $model = DirectorioInstitucional::find($id);
        if (! $model) {
            throw new DirectorioInstitucionalNotFoundException($id);
        }
        $model->update($data);
        $model->load('secretaria');

        return DirectorioInstitucionalDTO::fromModel($model->fresh());
    }

    public function delete(int $id): bool
    {
        $model = DirectorioInstitucional::find($id);
        if (! $model) {
            throw new DirectorioInstitucionalNotFoundException($id);
        }

        return $model->delete();
    }
}
