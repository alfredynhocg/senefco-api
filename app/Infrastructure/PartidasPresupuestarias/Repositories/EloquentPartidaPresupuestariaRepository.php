<?php

namespace App\Infrastructure\PartidasPresupuestarias\Repositories;

use App\Application\PartidasPresupuestarias\DTOs\PartidaPresupuestariaDTO;
use App\Domain\PartidasPresupuestarias\Contracts\PartidaPresupuestariaRepositoryInterface;
use App\Infrastructure\PartidasPresupuestarias\Models\PartidaPresupuestaria;

class EloquentPartidaPresupuestariaRepository implements PartidaPresupuestariaRepositoryInterface
{
    public function findByPresupuesto(int $presupuestoId): array
    {
        return PartidaPresupuestaria::where('presupuesto_id', $presupuestoId)
            ->orderBy('codigo')
            ->get()
            ->map(fn ($m) => PartidaPresupuestariaDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): PartidaPresupuestariaDTO
    {
        $model = PartidaPresupuestaria::find($id);
        if (! $model) {
            throw new \RuntimeException("Partida '{$id}' no encontrada.", 404);
        }

        return PartidaPresupuestariaDTO::fromModel($model);
    }

    public function create(array $data): PartidaPresupuestariaDTO
    {
        $model = PartidaPresupuestaria::create($data);

        return PartidaPresupuestariaDTO::fromModel($model);
    }

    public function update(int $id, array $data): PartidaPresupuestariaDTO
    {
        /** @var PartidaPresupuestaria $model */
        $model = PartidaPresupuestaria::find($id);
        if (! $model) {
            throw new \RuntimeException("Partida '{$id}' no encontrada.", 404);
        }
        $model->update($data);

        return PartidaPresupuestariaDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return PartidaPresupuestaria::destroy($ids) > 0;
    }
}
