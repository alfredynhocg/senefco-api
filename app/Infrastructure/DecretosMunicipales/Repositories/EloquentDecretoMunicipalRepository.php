<?php

namespace App\Infrastructure\DecretosMunicipales\Repositories;

use App\Application\DecretosMunicipales\DTOs\DecretoMunicipalDTO;
use App\Domain\DecretosMunicipales\Contracts\DecretoMunicipalRepositoryInterface;
use App\Domain\DecretosMunicipales\Exceptions\DecretoMunicipalNotFoundException;
use App\Infrastructure\DecretosMunicipales\Models\DecretoMunicipal;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentDecretoMunicipalRepository implements DecretoMunicipalRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloPublicados = false, ?string $tipo = null): array
    {
        $q = DecretoMunicipal::query();

        if ($soloPublicados) {
            $q->where('publicado_en_web', true)->where('estado', 'publicado');
        }

        if ($tipo) {
            $q->where('tipo', $tipo);
        }

        if ($pagination->query) {
            $q->where(function ($sub) use ($pagination) {
                $sub->where('titulo', 'like', '%'.$pagination->query.'%')
                    ->orWhere('numero', 'like', '%'.$pagination->query.'%');
            });
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data'  => collect($paginated->items())->map(fn ($m) => DecretoMunicipalDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): DecretoMunicipalDTO
    {
        $model = DecretoMunicipal::find($id);
        if (! $model) {
            throw new DecretoMunicipalNotFoundException($id);
        }

        return DecretoMunicipalDTO::fromModel($model);
    }

    public function create(array $data): DecretoMunicipalDTO
    {
        $model = DecretoMunicipal::create($data);

        return DecretoMunicipalDTO::fromModel($model);
    }

    public function update(int $id, array $data): DecretoMunicipalDTO
    {
        $model = DecretoMunicipal::find($id);
        if (! $model) {
            throw new DecretoMunicipalNotFoundException($id);
        }
        $model->update($data);

        return DecretoMunicipalDTO::fromModel($model->fresh());
    }

    public function delete(int|array $ids): bool
    {
        return DecretoMunicipal::destroy($ids) > 0;
    }
}
