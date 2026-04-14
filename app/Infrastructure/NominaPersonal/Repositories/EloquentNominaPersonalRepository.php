<?php

namespace App\Infrastructure\NominaPersonal\Repositories;

use App\Application\NominaPersonal\DTOs\NominaPersonalDTO;
use App\Domain\NominaPersonal\Contracts\NominaPersonalRepositoryInterface;
use App\Domain\NominaPersonal\Exceptions\NominaPersonalNotFoundException;
use App\Infrastructure\NominaPersonal\Models\NominaPersonal;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentNominaPersonalRepository implements NominaPersonalRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloActivos = false): array
    {
        $q = NominaPersonal::with('secretaria');

        if ($soloActivos) {
            $q->where('activo', true);
        }

        if ($pagination->query) {
            $q->where(function ($query) use ($pagination) {
                $query->where('nombre', 'like', "%{$pagination->query}%")
                    ->orWhere('apellido', 'like', "%{$pagination->query}%")
                    ->orWhere('cargo', 'like', "%{$pagination->query}%");
            });
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => NominaPersonalDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): NominaPersonalDTO
    {
        $model = NominaPersonal::with('secretaria')->find($id);
        if (! $model) {
            throw new NominaPersonalNotFoundException($id);
        }

        return NominaPersonalDTO::fromModel($model);
    }

    public function create(array $data): NominaPersonalDTO
    {
        $model = NominaPersonal::create($data);

        return NominaPersonalDTO::fromModel($model->load('secretaria'));
    }

    public function update(int $id, array $data): NominaPersonalDTO
    {
        $model = NominaPersonal::find($id);
        if (! $model) {
            throw new NominaPersonalNotFoundException($id);
        }
        $model->update($data);

        return NominaPersonalDTO::fromModel($model->load('secretaria'));
    }

    public function delete(int|array $ids): bool
    {
        return NominaPersonal::destroy($ids) > 0;
    }
}
