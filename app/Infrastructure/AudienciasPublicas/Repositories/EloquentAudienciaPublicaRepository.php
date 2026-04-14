<?php

namespace App\Infrastructure\AudienciasPublicas\Repositories;

use App\Application\AudienciasPublicas\DTOs\AudienciaPublicaDTO;
use App\Domain\AudienciasPublicas\Contracts\AudienciaPublicaRepositoryInterface;
use App\Domain\AudienciasPublicas\Exceptions\AudienciaPublicaNotFoundException;
use App\Infrastructure\AudienciasPublicas\Models\AudienciaPublica;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentAudienciaPublicaRepository implements AudienciaPublicaRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloActivos = false): array
    {
        $q = AudienciaPublica::query();

        if ($soloActivos) {
            $q->where('activo', true);
        }

        if ($pagination->query) {
            $q->where('titulo', 'like', "%{$pagination->query}%")
                ->orWhere('descripcion', 'like', "%{$pagination->query}%");
        }

        $paginated = $q->orderBy('created_at', 'desc')
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => AudienciaPublicaDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): AudienciaPublicaDTO
    {
        $model = AudienciaPublica::find($id);
        if (! $model) {
            throw new AudienciaPublicaNotFoundException($id);
        }

        return AudienciaPublicaDTO::fromModel($model);
    }

    public function create(array $data): AudienciaPublicaDTO
    {
        $model = AudienciaPublica::create($data);

        return AudienciaPublicaDTO::fromModel($model);
    }

    public function update(int $id, array $data): AudienciaPublicaDTO
    {
        $model = AudienciaPublica::find($id);
        if (! $model) {
            throw new AudienciaPublicaNotFoundException($id);
        }
        $model->update($data);

        return AudienciaPublicaDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return AudienciaPublica::destroy($ids) > 0;
    }
}
