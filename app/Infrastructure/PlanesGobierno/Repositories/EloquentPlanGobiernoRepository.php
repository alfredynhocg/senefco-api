<?php

namespace App\Infrastructure\PlanesGobierno\Repositories;

use App\Application\PlanesGobierno\DTOs\PlanGobiernoDTO;
use App\Domain\PlanesGobierno\Contracts\PlanGobiernoRepositoryInterface;
use App\Infrastructure\PlanesGobierno\Models\PlanGobierno;

class EloquentPlanGobiernoRepository implements PlanGobiernoRepositoryInterface
{
    public function all(): array
    {
        return PlanGobierno::orderBy('gestion_inicio', 'desc')
            ->get()
            ->map(fn ($m) => PlanGobiernoDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): PlanGobiernoDTO
    {
        $model = PlanGobierno::find($id);
        if (! $model) {
            throw new \RuntimeException("Plan de Gobierno '{$id}' no encontrado.", 404);
        }

        return PlanGobiernoDTO::fromModel($model);
    }

    public function create(array $data): PlanGobiernoDTO
    {
        $model = PlanGobierno::create($data);

        return PlanGobiernoDTO::fromModel($model);
    }

    public function update(int $id, array $data): PlanGobiernoDTO
    {
        /** @var PlanGobierno $model */
        $model = PlanGobierno::find($id);
        if (! $model) {
            throw new \RuntimeException("Plan de Gobierno '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return PlanGobiernoDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return PlanGobierno::destroy($ids) > 0;
    }
}
