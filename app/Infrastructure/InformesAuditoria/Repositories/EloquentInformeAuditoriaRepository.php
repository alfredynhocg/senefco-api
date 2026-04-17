<?php

namespace App\Infrastructure\InformesAuditoria\Repositories;

use App\Application\InformesAuditoria\DTOs\InformeAuditoriaDTO;
use App\Domain\InformesAuditoria\Contracts\InformeAuditoriaRepositoryInterface;
use App\Domain\InformesAuditoria\Exceptions\InformeAuditoriaNotFoundException;
use App\Infrastructure\InformesAuditoria\Models\InformeAuditoria;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentInformeAuditoriaRepository implements InformeAuditoriaRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloPublicados = false): array
    {
        $q = InformeAuditoria::query();

        if ($soloPublicados) {
            $q->where('publicado_en_web', true)->where('estado', 'publicado');
        }

        if ($pagination->query) {
            $q->where('nombre', 'like', '%'.$pagination->query.'%');
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => InformeAuditoriaDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): InformeAuditoriaDTO
    {
        $model = InformeAuditoria::find($id);
        if (! $model) {
            throw new InformeAuditoriaNotFoundException($id);
        }

        return InformeAuditoriaDTO::fromModel($model);
    }

    public function create(array $data): InformeAuditoriaDTO
    {
        $model = InformeAuditoria::create($data);

        return InformeAuditoriaDTO::fromModel($model);
    }

    public function update(int $id, array $data): InformeAuditoriaDTO
    {
        $model = InformeAuditoria::find($id);
        if (! $model) {
            throw new InformeAuditoriaNotFoundException($id);
        }
        $model->update($data);

        return InformeAuditoriaDTO::fromModel($model->fresh());
    }

    public function delete(int|array $ids): bool
    {
        return InformeAuditoria::destroy($ids) > 0;
    }
}
