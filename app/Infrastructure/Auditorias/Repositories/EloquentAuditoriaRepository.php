<?php

namespace App\Infrastructure\Auditorias\Repositories;

use App\Application\Auditorias\DTOs\AuditoriaDTO;
use App\Domain\Auditorias\Contracts\AuditoriaRepositoryInterface;
use App\Infrastructure\Auditorias\Models\Auditoria;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentAuditoriaRepository implements AuditoriaRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, array $filters = []): array
    {
        $q = Auditoria::with(['tipo', 'secretaria']);

        if ($pagination->query) {
            $q->where(function ($sub) use ($pagination) {
                $sub->where('titulo', 'like', "%{$pagination->query}%")
                    ->orWhere('codigo_auditoria', 'like', "%{$pagination->query}%");
            });
        }

        if (! empty($filters['tipo_id'])) {
            $q->where('tipo_auditoria_id', $filters['tipo_id']);
        }

        if (! empty($filters['secretaria_id'])) {
            $q->where('secretaria_auditada_id', $filters['secretaria_id']);
        }

        if (isset($filters['publico'])) {
            $q->where('publico', $filters['publico']);
        }

        if (! empty($filters['soloActivos'])) {
            $q->where('activo', true);
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => AuditoriaDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): AuditoriaDTO
    {
        $model = Auditoria::with(['tipo', 'secretaria', 'hallazgos.secretariaResponsable'])->find($id);
        if (! $model) {
            throw new \RuntimeException("Auditoría '{$id}' no encontrada.", 404);
        }

        return AuditoriaDTO::fromModel($model);
    }

    public function findBySlug(string $slug): AuditoriaDTO
    {
        $model = Auditoria::with(['tipo', 'secretaria'])->where('slug', $slug)->where('activo', true)->first();
        if (! $model) {
            throw new \RuntimeException("Auditoría '{$slug}' no encontrada.", 404);
        }

        return AuditoriaDTO::fromModel($model);
    }

    public function create(array $data): AuditoriaDTO
    {
        $model = Auditoria::create($data);

        return AuditoriaDTO::fromModel($model->load(['tipo', 'secretaria']));
    }

    public function update(int $id, array $data): AuditoriaDTO
    {
        /** @var Auditoria $model */
        $model = Auditoria::find($id);
        if (! $model) {
            throw new \RuntimeException("Auditoría '{$id}' no encontrada.", 404);
        }
        $model->update($data);

        return AuditoriaDTO::fromModel($model->load(['tipo', 'secretaria']));
    }

    public function delete(int|array $ids): bool
    {
        return Auditoria::destroy($ids) > 0;
    }
}
