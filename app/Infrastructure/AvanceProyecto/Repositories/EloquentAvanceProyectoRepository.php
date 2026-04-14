<?php

namespace App\Infrastructure\AvanceProyecto\Repositories;

use App\Application\AvanceProyecto\DTOs\AvanceProyectoDTO;
use App\Domain\AvanceProyecto\Contracts\AvanceProyectoRepositoryInterface;
use App\Infrastructure\AvanceProyecto\Models\AvanceProyecto;

class EloquentAvanceProyectoRepository implements AvanceProyectoRepositoryInterface
{
    public function findByProyecto(int $proyectoId): array
    {
        return AvanceProyecto::where('proyecto_id', $proyectoId)
            ->orderBy('fecha_reporte', 'desc')
            ->orderBy('id', 'desc')
            ->get()
            ->map(fn ($m) => AvanceProyectoDTO::fromModel($m))
            ->all();
    }

    public function create(array $data): AvanceProyectoDTO
    {
        $model = AvanceProyecto::create($data);

        return AvanceProyectoDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return AvanceProyecto::destroy($ids) > 0;
    }
}
