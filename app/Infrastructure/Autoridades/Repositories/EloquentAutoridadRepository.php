<?php

namespace App\Infrastructure\Autoridades\Repositories;

use App\Application\Autoridades\DTOs\AutoridadDTO;
use App\Domain\Autoridades\Contracts\AutoridadRepositoryInterface;
use App\Domain\Autoridades\Exceptions\AutoridadNotFoundException;
use App\Infrastructure\Autoridades\Models\Autoridad;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentAutoridadRepository implements AutoridadRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloActivos = false): array
    {
        $q = Autoridad::query();

        if ($soloActivos) {
            $q->where('activo', true);
        }

        if ($pagination->query) {
            $q->where('nombre_completo', 'like', "%{$pagination->query}%")
                ->orWhere('cargo', 'like', "%{$pagination->query}%");
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => AutoridadDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): AutoridadDTO
    {
        $model = Autoridad::find($id);
        if (! $model) {
            throw new AutoridadNotFoundException($id);
        }

        return AutoridadDTO::fromModel($model);
    }

    public function findBySlug(string $slug): AutoridadDTO
    {
        $model = Autoridad::where('slug', $slug)->first();
        if (! $model) {
            throw new AutoridadNotFoundException($slug);
        }

        return AutoridadDTO::fromModel($model);
    }

    public function findByTipo(string $tipo): AutoridadDTO
    {
        $model = Autoridad::where('tipo', $tipo)->where('activo', true)->orderBy('orden')->first();
        if (! $model) {
            throw new AutoridadNotFoundException($tipo);
        }

        return AutoridadDTO::fromModel($model);
    }

    public function create(array $data): AutoridadDTO
    {
        $model = Autoridad::create($data);

        return AutoridadDTO::fromModel($model);
    }

    public function update(int $id, array $data): AutoridadDTO
    {
        /** @var Autoridad $model */
        $model = Autoridad::find($id);
        if (! $model) {
            throw new AutoridadNotFoundException($id);
        }
        $model->update($data);

        return AutoridadDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return Autoridad::destroy($ids) > 0;
    }
}
