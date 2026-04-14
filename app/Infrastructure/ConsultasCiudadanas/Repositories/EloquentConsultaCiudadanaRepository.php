<?php

namespace App\Infrastructure\ConsultasCiudadanas\Repositories;

use App\Application\ConsultasCiudadanas\DTOs\ConsultaCiudadanaDTO;
use App\Domain\ConsultasCiudadanas\Contracts\ConsultaCiudadanaRepositoryInterface;
use App\Domain\ConsultasCiudadanas\Exceptions\ConsultaCiudadanaNotFoundException;
use App\Infrastructure\ConsultasCiudadanas\Models\ConsultaCiudadana;

class EloquentConsultaCiudadanaRepository implements ConsultaCiudadanaRepositoryInterface
{
    public function paginate(int $pageIndex, int $pageSize, string $query, string $tipo, string $estado): array
    {
        $q = ConsultaCiudadana::query();

        if ($query) {
            $q->where(function ($sub) use ($query) {
                $sub->where('ciudadano_nombre', 'like', "%{$query}%")
                    ->orWhere('asunto', 'like', "%{$query}%")
                    ->orWhere('descripcion', 'like', "%{$query}%");
            });
        }

        if ($tipo) {
            $q->where('tipo', $tipo);
        }

        if ($estado) {
            $q->where('estado', $estado);
        }

        $paginated = $q->orderBy('created_at', 'desc')
            ->paginate($pageSize, ['*'], 'page', $pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => ConsultaCiudadanaDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): ConsultaCiudadanaDTO
    {
        $model = ConsultaCiudadana::find($id);
        if (! $model) {
            throw new ConsultaCiudadanaNotFoundException($id);
        }

        return ConsultaCiudadanaDTO::fromModel($model);
    }

    public function create(array $data): ConsultaCiudadanaDTO
    {
        $model = ConsultaCiudadana::create($data);

        return ConsultaCiudadanaDTO::fromModel($model);
    }

    public function responder(int $id, array $data): ConsultaCiudadanaDTO
    {
        $model = ConsultaCiudadana::find($id);
        if (! $model) {
            throw new ConsultaCiudadanaNotFoundException($id);
        }
        $model->update($data);

        return ConsultaCiudadanaDTO::fromModel($model->fresh());
    }

    public function delete(int $id): bool
    {
        $model = ConsultaCiudadana::find($id);
        if (! $model) {
            throw new ConsultaCiudadanaNotFoundException($id);
        }

        return $model->delete();
    }
}
