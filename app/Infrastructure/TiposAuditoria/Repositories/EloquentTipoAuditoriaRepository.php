<?php

namespace App\Infrastructure\TiposAuditoria\Repositories;

use App\Application\TiposAuditoria\DTOs\TipoAuditoriaDTO;
use App\Domain\TiposAuditoria\Contracts\TipoAuditoriaRepositoryInterface;
use App\Infrastructure\TiposAuditoria\Models\TipoAuditoria;

class EloquentTipoAuditoriaRepository implements TipoAuditoriaRepositoryInterface
{
    public function all(): array
    {
        return TipoAuditoria::where('activo', true)
            ->orderBy('nombre')
            ->get()
            ->map(fn ($m) => TipoAuditoriaDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): TipoAuditoriaDTO
    {
        $model = TipoAuditoria::find($id);
        if (! $model) {
            throw new \RuntimeException("Tipo de auditoría '{$id}' no encontrado.", 404);
        }

        return TipoAuditoriaDTO::fromModel($model);
    }

    public function create(array $data): TipoAuditoriaDTO
    {
        $model = TipoAuditoria::create($data);

        return TipoAuditoriaDTO::fromModel($model);
    }

    public function update(int $id, array $data): TipoAuditoriaDTO
    {
        /** @var TipoAuditoria $model */
        $model = TipoAuditoria::find($id);
        if (! $model) {
            throw new \RuntimeException("Tipo de auditoría '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return TipoAuditoriaDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return TipoAuditoria::destroy($ids) > 0;
    }
}
