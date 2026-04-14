<?php

namespace App\Infrastructure\ContactosMunicipales\Repositories;

use App\Application\ContactosMunicipales\DTOs\ContactoMunicipalDTO;
use App\Domain\ContactosMunicipales\Contracts\ContactoMunicipalRepositoryInterface;
use App\Domain\ContactosMunicipales\Exceptions\ContactoMunicipalNotFoundException;
use App\Infrastructure\ContactosMunicipales\Models\ContactoMunicipal;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentContactoMunicipalRepository implements ContactoMunicipalRepositoryInterface
{
    public function paginate(PaginationDTO $pagination): array
    {
        $q = ContactoMunicipal::query();

        if ($pagination->query) {
            $q->where('nombre_area', 'like', "%{$pagination->query}%")
                ->orWhere('encargado', 'like', "%{$pagination->query}%");
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => ContactoMunicipalDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): ContactoMunicipalDTO
    {
        $model = ContactoMunicipal::find($id);
        if (! $model) {
            throw new ContactoMunicipalNotFoundException($id);
        }

        return ContactoMunicipalDTO::fromModel($model);
    }

    public function create(array $data): ContactoMunicipalDTO
    {
        $model = ContactoMunicipal::create($data);

        return ContactoMunicipalDTO::fromModel($model);
    }

    public function update(int $id, array $data): ContactoMunicipalDTO
    {
        /** @var ContactoMunicipal $model */
        $model = ContactoMunicipal::find($id);
        if (! $model) {
            throw new ContactoMunicipalNotFoundException($id);
        }
        $model->update($data);

        return ContactoMunicipalDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return ContactoMunicipal::destroy($ids) > 0;
    }
}
