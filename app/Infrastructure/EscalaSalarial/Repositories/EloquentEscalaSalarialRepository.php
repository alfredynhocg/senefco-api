<?php

namespace App\Infrastructure\EscalaSalarial\Repositories;

use App\Application\EscalaSalarial\DTOs\EscalaSalarialDTO;
use App\Domain\EscalaSalarial\Contracts\EscalaSalarialRepositoryInterface;
use App\Domain\EscalaSalarial\Exceptions\EscalaSalarialNotFoundException;
use App\Infrastructure\EscalaSalarial\Models\EscalaSalarial;

class EloquentEscalaSalarialRepository implements EscalaSalarialRepositoryInterface
{
    public function all(): array
    {
        return EscalaSalarial::orderBy('nivel')
            ->get()
            ->map(fn ($m) => EscalaSalarialDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): EscalaSalarialDTO
    {
        $model = EscalaSalarial::find($id);
        if (! $model) {
            throw new EscalaSalarialNotFoundException($id);
        }

        return EscalaSalarialDTO::fromModel($model);
    }

    public function create(array $data): EscalaSalarialDTO
    {
        $model = EscalaSalarial::create($data);

        return EscalaSalarialDTO::fromModel($model);
    }

    public function update(int $id, array $data): EscalaSalarialDTO
    {
        /** @var EscalaSalarial $model */
        $model = EscalaSalarial::find($id);
        if (! $model) {
            throw new EscalaSalarialNotFoundException($id);
        }
        $model->update($data);

        return EscalaSalarialDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return EscalaSalarial::destroy($ids) > 0;
    }
}
