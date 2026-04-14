<?php

namespace App\Infrastructure\IndicadoresGestion\Repositories;

use App\Application\IndicadoresGestion\DTOs\IndicadorGestionDTO;
use App\Domain\IndicadoresGestion\Contracts\IndicadorGestionRepositoryInterface;
use App\Infrastructure\IndicadoresGestion\Models\IndicadorGestion;

class EloquentIndicadorGestionRepository implements IndicadorGestionRepositoryInterface
{
    public function all(array $filters = []): array
    {
        $query = IndicadorGestion::with(['categoria', 'ultimoValor'])->orderBy('orden_dashboard');

        if (isset($filters['categoria_id']) && $filters['categoria_id'] !== null) {
            $query->where('categoria_id', $filters['categoria_id']);
        }

        if (isset($filters['activo']) && $filters['activo'] !== null) {
            $query->where('activo', $filters['activo']);
        }

        if (isset($filters['publico']) && $filters['publico'] !== null) {
            $query->where('publico', $filters['publico']);
        }

        return $query->get()->map(fn ($model) => IndicadorGestionDTO::fromModel($model))->all();
    }

    public function findById(int $id): IndicadorGestionDTO
    {
        $model = IndicadorGestion::with(['categoria', 'ultimoValor'])->find($id);
        if (! $model) {
            throw new \RuntimeException("Indicador de gestión '{$id}' no encontrado.", 404);
        }

        return IndicadorGestionDTO::fromModel($model);
    }

    public function create(array $data): IndicadorGestionDTO
    {
        $model = IndicadorGestion::create($data);

        return IndicadorGestionDTO::fromModel($model->load(['categoria', 'ultimoValor']));
    }

    public function update(int $id, array $data): IndicadorGestionDTO
    {
        $model = IndicadorGestion::find($id);
        if (! $model) {
            throw new \RuntimeException("Indicador de gestión '{$id}' no encontrado.", 404);
        }

        $model->update($data);

        return IndicadorGestionDTO::fromModel($model->fresh(['categoria', 'ultimoValor']));
    }

    public function delete(int|array $ids): bool
    {
        return IndicadorGestion::destroy($ids) > 0;
    }
}
