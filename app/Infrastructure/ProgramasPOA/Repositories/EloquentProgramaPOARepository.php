<?php

namespace App\Infrastructure\ProgramasPOA\Repositories;

use App\Application\ProgramasPOA\DTOs\ProgramaPOADTO;
use App\Domain\ProgramasPOA\Contracts\ProgramaPOARepositoryInterface;
use App\Infrastructure\ProgramasPOA\Models\ProgramaPOA;

class EloquentProgramaPOARepository implements ProgramaPOARepositoryInterface
{
    public function findByPoa(int $poaId): array
    {
        return ProgramaPOA::where('poa_id', $poaId)
            ->orderBy('codigo')
            ->get()
            ->map(fn ($m) => ProgramaPOADTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): ProgramaPOADTO
    {
        $model = ProgramaPOA::find($id);
        if (! $model) {
            throw new \RuntimeException("Programa POA '{$id}' no encontrado.", 404);
        }

        return ProgramaPOADTO::fromModel($model);
    }

    public function create(array $data): ProgramaPOADTO
    {
        $model = ProgramaPOA::create($data);

        return ProgramaPOADTO::fromModel($model);
    }

    public function update(int $id, array $data): ProgramaPOADTO
    {
        /** @var ProgramaPOA $model */
        $model = ProgramaPOA::find($id);
        if (! $model) {
            throw new \RuntimeException("Programa POA '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return ProgramaPOADTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return ProgramaPOA::destroy($ids) > 0;
    }
}
