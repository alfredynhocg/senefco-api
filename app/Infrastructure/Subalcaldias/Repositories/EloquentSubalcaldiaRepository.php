<?php

namespace App\Infrastructure\Subsenefcos\Repositories;

use App\Application\Subsenefcos\DTOs\SubsenefcoDTO;
use App\Domain\Subsenefcos\Contracts\SubsenefcoRepositoryInterface;
use App\Domain\Subsenefcos\Exceptions\SubsenefcoNotFoundException;
use App\Infrastructure\Subsenefcos\Models\Subsenefco;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentSubsenefcoRepository implements SubsenefcoRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloActivos = false): array
    {
        $q = Subsenefco::query();

        if ($soloActivos) {
            $q->where('activa', true);
        }

        if ($pagination->query) {
            $q->where('nombre', 'like', "%{$pagination->query}%")
                ->orWhere('zona_cobertura', 'like', "%{$pagination->query}%");
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => SubsenefcoDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): SubsenefcoDTO
    {
        $model = Subsenefco::find($id);
        if (! $model) {
            throw new SubsenefcoNotFoundException($id);
        }

        return SubsenefcoDTO::fromModel($model);
    }

    public function findBySlug(string $slug): SubsenefcoDTO
    {
        $model = Subsenefco::where('slug', $slug)->first();
        if (! $model) {
            throw new SubsenefcoNotFoundException($slug);
        }

        return SubsenefcoDTO::fromModel($model);
    }

    public function create(array $data): SubsenefcoDTO
    {
        $model = Subsenefco::create($data);

        return SubsenefcoDTO::fromModel($model);
    }

    public function update(int $id, array $data): SubsenefcoDTO
    {
        $model = Subsenefco::find($id);
        if (! $model) {
            throw new SubsenefcoNotFoundException($id);
        }
        $model->update($data);

        return SubsenefcoDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return Subsenefco::destroy($ids) > 0;
    }
}
