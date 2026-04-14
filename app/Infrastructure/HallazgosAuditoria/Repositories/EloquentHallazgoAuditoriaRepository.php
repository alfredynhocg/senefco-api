<?php

namespace App\Infrastructure\HallazgosAuditoria\Repositories;

use App\Application\HallazgosAuditoria\DTOs\HallazgoAuditoriaDTO;
use App\Domain\HallazgosAuditoria\Contracts\HallazgoAuditoriaRepositoryInterface;
use App\Infrastructure\HallazgosAuditoria\Models\HallazgoAuditoria;

class EloquentHallazgoAuditoriaRepository implements HallazgoAuditoriaRepositoryInterface
{
    public function findByAuditoria(int $auditoriaId): array
    {
        return HallazgoAuditoria::with('secretariaResponsable')
            ->where('auditoria_id', $auditoriaId)
            ->get()
            ->map(fn ($m) => HallazgoAuditoriaDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): HallazgoAuditoriaDTO
    {
        $model = HallazgoAuditoria::with('secretariaResponsable')->find($id);
        if (! $model) {
            throw new \RuntimeException("Hallazgo '{$id}' no encontrado.", 404);
        }

        return HallazgoAuditoriaDTO::fromModel($model);
    }

    public function create(array $data): HallazgoAuditoriaDTO
    {
        $model = HallazgoAuditoria::create($data);

        return HallazgoAuditoriaDTO::fromModel($model->load('secretariaResponsable'));
    }

    public function update(int $id, array $data): HallazgoAuditoriaDTO
    {
        /** @var HallazgoAuditoria $model */
        $model = HallazgoAuditoria::find($id);
        if (! $model) {
            throw new \RuntimeException("Hallazgo '{$id}' no encontrado.", 404);
        }
        $model->update($data);

        return HallazgoAuditoriaDTO::fromModel($model->load('secretariaResponsable'));
    }

    public function delete(int|array $ids): bool
    {
        return HallazgoAuditoria::destroy($ids) > 0;
    }
}
