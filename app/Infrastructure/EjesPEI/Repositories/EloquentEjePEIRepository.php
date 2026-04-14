<?php

namespace App\Infrastructure\EjesPEI\Repositories;

use App\Application\EjesPEI\DTOs\EjePEIDTO;
use App\Domain\EjesPEI\Contracts\EjePEIRepositoryInterface;
use App\Infrastructure\EjesPEI\Models\EjePEI;

class EloquentEjePEIRepository implements EjePEIRepositoryInterface
{
    public function findByPei(int $peiId): array
    {
        return EjePEI::where('pei_id', $peiId)
            ->orderBy('numero_eje')
            ->get()
            ->map(fn ($m) => EjePEIDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): EjePEIDTO
    {
        $model = EjePEI::find($id);
        if (! $model) {
            throw new \RuntimeException("Eje PEI '{$id}' no encontrado.", 404);
        }

        return EjePEIDTO::fromModel($model);
    }

    public function create(array $data): EjePEIDTO
    {
        $model = EjePEI::create($data);

        return EjePEIDTO::fromModel($model);
    }

    public function update(int $id, array $data): EjePEIDTO
    {
        /** @var EjePEI $model */
        $model = EjePEI::find($id);
        if (! $model) {
            throw new \RuntimeException("Eje PEI '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return EjePEIDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return EjePEI::destroy($ids) > 0;
    }
}
