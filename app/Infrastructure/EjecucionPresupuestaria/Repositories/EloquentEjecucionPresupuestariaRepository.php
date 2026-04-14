<?php

namespace App\Infrastructure\EjecucionPresupuestaria\Repositories;

use App\Application\EjecucionPresupuestaria\DTOs\EjecucionPresupuestariaDTO;
use App\Domain\EjecucionPresupuestaria\Contracts\EjecucionPresupuestariaRepositoryInterface;
use App\Infrastructure\EjecucionPresupuestaria\Models\EjecucionPresupuestaria;

class EloquentEjecucionPresupuestariaRepository implements EjecucionPresupuestariaRepositoryInterface
{
    public function findByPresupuesto(int $presupuestoId): array
    {
        return EjecucionPresupuestaria::whereHas('partida', fn ($q) => $q->where('presupuesto_id', $presupuestoId))
            ->orderBy('gestion', 'desc')
            ->orderBy('mes', 'desc')
            ->get()
            ->map(fn ($m) => EjecucionPresupuestariaDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): EjecucionPresupuestariaDTO
    {
        $model = EjecucionPresupuestaria::find($id);
        if (! $model) {
            throw new \RuntimeException("Registro de ejecución '{$id}' no encontrado.", 404);
        }

        return EjecucionPresupuestariaDTO::fromModel($model);
    }

    public function create(array $data): EjecucionPresupuestariaDTO
    {
        $model = EjecucionPresupuestaria::create($data);

        return EjecucionPresupuestariaDTO::fromModel($model);
    }

    public function update(int $id, array $data): EjecucionPresupuestariaDTO
    {
        $model = EjecucionPresupuestaria::find($id);
        if (! $model) {
            throw new \RuntimeException("Registro de ejecución '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return EjecucionPresupuestariaDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return EjecucionPresupuestaria::destroy($ids) > 0;
    }
}
