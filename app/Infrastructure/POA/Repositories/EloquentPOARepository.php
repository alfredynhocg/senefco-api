<?php

namespace App\Infrastructure\POA\Repositories;

use App\Application\POA\DTOs\POADTO;
use App\Domain\POA\Contracts\POARepositoryInterface;
use App\Infrastructure\POA\Models\POA;

class EloquentPOARepository implements POARepositoryInterface
{
    public function findByGestion(int $gestion): ?POADTO
    {
        $model = POA::with('secretaria')->where('gestion', $gestion)->first();

        return $model ? POADTO::fromModel($model) : null;
    }

    public function findById(int $id): POADTO
    {
        $model = POA::with('secretaria')->find($id);
        if (! $model) {
            throw new \RuntimeException("POA '{$id}' no encontrado.", 404);
        }

        return POADTO::fromModel($model);
    }

    public function create(array $data): POADTO
    {
        $model = POA::create($data);

        return POADTO::fromModel($model->load('secretaria'));
    }

    public function update(int $id, array $data): POADTO
    {
        $model = POA::find($id);
        if (! $model) {
            throw new \RuntimeException("POA '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return POADTO::fromModel($model->load('secretaria'));
    }

    public function delete(int|array $ids): bool
    {
        return POA::destroy($ids) > 0;
    }

    public function all(): array
    {
        return POA::with('secretaria')
            ->orderBy('gestion', 'desc')
            ->get()
            ->map(fn ($m) => POADTO::fromModel($m))
            ->all();
    }
}
