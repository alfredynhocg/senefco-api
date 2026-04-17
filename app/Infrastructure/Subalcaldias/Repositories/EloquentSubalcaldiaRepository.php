<?php

namespace App\Infrastructure\Subcenefcos\Repositories;

use App\Application\Subcenefcos\DTOs\SubcenefcoDTO;
use App\Domain\Subcenefcos\Contracts\SubcenefcoRepositoryInterface;
use App\Domain\Subcenefcos\Exceptions\SubcenefcoNotFoundException;
use App\Infrastructure\Subcenefcos\Models\Subcenefco;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentSubcenefcoRepository implements SubcenefcoRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloActivos = false): array
    {
        $q = Subcenefco::query();

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
            'data' => collect($paginated->items())->map(fn ($m) => SubcenefcoDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): SubcenefcoDTO
    {
        $model = Subcenefco::find($id);
        if (! $model) {
            throw new SubcenefcoNotFoundException($id);
        }

        return SubcenefcoDTO::fromModel($model);
    }

    public function findBySlug(string $slug): SubcenefcoDTO
    {
        $model = Subcenefco::where('slug', $slug)->first();
        if (! $model) {
            throw new SubcenefcoNotFoundException($slug);
        }

        return SubcenefcoDTO::fromModel($model);
    }

    public function create(array $data): SubcenefcoDTO
    {
        $model = Subcenefco::create($data);

        return SubcenefcoDTO::fromModel($model);
    }

    public function update(int $id, array $data): SubcenefcoDTO
    {
        $model = Subcenefco::find($id);
        if (! $model) {
            throw new SubcenefcoNotFoundException($id);
        }
        $model->update($data);

        return SubcenefcoDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return Subcenefco::destroy($ids) > 0;
    }
}
