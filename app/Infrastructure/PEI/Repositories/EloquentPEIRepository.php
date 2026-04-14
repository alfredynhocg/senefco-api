<?php

namespace App\Infrastructure\PEI\Repositories;

use App\Application\PEI\DTOs\PEIDTO;
use App\Domain\PEI\Contracts\PEIRepositoryInterface;
use App\Infrastructure\PEI\Models\PlanEstrategicoInstitucional;

class EloquentPEIRepository implements PEIRepositoryInterface
{
    public function all(): array
    {
        return PlanEstrategicoInstitucional::orderBy('anio_inicio', 'desc')
            ->get()
            ->map(fn ($m) => PEIDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): PEIDTO
    {
        $model = PlanEstrategicoInstitucional::find($id);
        if (! $model) {
            throw new \RuntimeException("PEI '{$id}' no encontrado.", 404);
        }

        return PEIDTO::fromModel($model);
    }

    public function create(array $data): PEIDTO
    {
        $model = PlanEstrategicoInstitucional::create($data);

        return PEIDTO::fromModel($model);
    }

    public function update(int $id, array $data): PEIDTO
    {
        /** @var PlanEstrategicoInstitucional $model */
        $model = PlanEstrategicoInstitucional::find($id);
        if (! $model) {
            throw new \RuntimeException("PEI '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return PEIDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return PlanEstrategicoInstitucional::destroy($ids) > 0;
    }
}
