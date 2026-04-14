<?php

namespace App\Infrastructure\Presupuestos\Repositories;

use App\Application\Presupuestos\DTOs\PresupuestoDTO;
use App\Domain\Presupuestos\Contracts\PresupuestoRepositoryInterface;
use App\Infrastructure\Presupuestos\Models\Presupuesto;

class EloquentPresupuestoRepository implements PresupuestoRepositoryInterface
{
    public function findByGestion(int $gestion): ?PresupuestoDTO
    {
        $model = Presupuesto::with('secretaria')->where('gestion', $gestion)->first();

        return $model ? PresupuestoDTO::fromModel($model) : null;
    }

    public function findById(int $id): PresupuestoDTO
    {
        $model = Presupuesto::with('secretaria')->find($id);
        if (! $model) {
            throw new \RuntimeException("Presupuesto '{$id}' no encontrado.", 404);
        }

        return PresupuestoDTO::fromModel($model);
    }

    public function create(array $data): PresupuestoDTO
    {
        $model = Presupuesto::create($data);

        return PresupuestoDTO::fromModel($model->load('secretaria'));
    }

    public function update(int $id, array $data): PresupuestoDTO
    {
        $model = Presupuesto::find($id);
        if (! $model) {
            throw new \RuntimeException("Presupuesto '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return PresupuestoDTO::fromModel($model->load('secretaria'));
    }

    public function delete(int|array $ids): bool
    {
        return Presupuesto::destroy($ids) > 0;
    }

    public function all(): array
    {
        return Presupuesto::with('secretaria')
            ->orderBy('gestion', 'desc')
            ->get()
            ->map(fn ($m) => PresupuestoDTO::fromModel($m))
            ->all();
    }
}
