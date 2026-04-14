<?php

namespace App\Infrastructure\RequisitosTramite\Repositories;

use App\Application\RequisitosTramite\DTOs\RequisitoDTO;
use App\Domain\RequisitosTramite\Contracts\RequisitoRepositoryInterface;
use App\Domain\RequisitosTramite\Exceptions\RequisitoNotFoundException;
use App\Infrastructure\RequisitosTramite\Models\Requisito;

class EloquentRequisitoRepository implements RequisitoRepositoryInterface
{
    public function findByTramite(int $tramiteId): array
    {
        return Requisito::where('tramite_id', $tramiteId)
            ->orderBy('orden', 'asc')
            ->get()
            ->map(fn ($m) => RequisitoDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): RequisitoDTO
    {
        $model = Requisito::find($id);
        if (! $model) {
            throw new RequisitoNotFoundException($id);
        }

        return RequisitoDTO::fromModel($model);
    }

    public function create(array $data): RequisitoDTO
    {
        $model = Requisito::create($data);

        return RequisitoDTO::fromModel($model);
    }

    public function update(int $id, array $data): RequisitoDTO
    {
        $model = Requisito::find($id);
        if (! $model) {
            throw new RequisitoNotFoundException($id);
        }
        $model->update($data);

        return RequisitoDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return Requisito::destroy($ids) > 0;
    }
}
