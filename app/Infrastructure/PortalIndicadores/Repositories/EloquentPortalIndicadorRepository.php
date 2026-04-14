<?php

namespace App\Infrastructure\PortalIndicadores\Repositories;

use App\Application\PortalIndicadores\DTOs\PortalIndicadorDTO;
use App\Domain\PortalIndicadores\Contracts\PortalIndicadorRepositoryInterface;
use App\Domain\PortalIndicadores\Exceptions\PortalIndicadorNotFoundException;
use App\Infrastructure\PortalIndicadores\Models\PortalIndicador;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentPortalIndicadorRepository implements PortalIndicadorRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, ?string $categoria, ?string $estado): array
    {
        $q = PortalIndicador::query();

        if ($pagination->query) {
            $q->where(function ($sq) use ($pagination) {
                $sq->where('nombre', 'like', "%{$pagination->query}%")
                    ->orWhere('descripcion', 'like', "%{$pagination->query}%")
                    ->orWhere('responsable', 'like', "%{$pagination->query}%");
            });
        }

        if ($categoria) {
            $q->where('categoria', $categoria);
        }
        if ($estado) {
            $q->where('estado', $estado);
        }

        $paginated = $q->orderBy('nombre')
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => PortalIndicadorDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): PortalIndicadorDTO
    {
        $model = PortalIndicador::find($id);
        if (! $model) {
            throw new PortalIndicadorNotFoundException($id);
        }

        return PortalIndicadorDTO::fromModel($model);
    }

    public function create(array $data): PortalIndicadorDTO
    {
        return PortalIndicadorDTO::fromModel(PortalIndicador::create($data));
    }

    public function update(int $id, array $data): PortalIndicadorDTO
    {
        $model = PortalIndicador::find($id);
        if (! $model) {
            throw new PortalIndicadorNotFoundException($id);
        }
        $model->update($data);

        return PortalIndicadorDTO::fromModel($model->fresh());
    }

    public function delete(int|array $ids): bool
    {
        return PortalIndicador::destroy($ids) > 0;
    }
}
