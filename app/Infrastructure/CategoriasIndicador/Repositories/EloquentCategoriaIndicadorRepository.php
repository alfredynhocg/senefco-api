<?php

namespace App\Infrastructure\CategoriasIndicador\Repositories;

use App\Application\CategoriasIndicador\DTOs\CategoriaIndicadorDTO;
use App\Domain\CategoriasIndicador\Contracts\CategoriaIndicadorRepositoryInterface;
use App\Infrastructure\CategoriasIndicador\Models\CategoriaIndicador;

class EloquentCategoriaIndicadorRepository implements CategoriaIndicadorRepositoryInterface
{
    public function all(): array
    {
        return CategoriaIndicador::where('activa', true)
            ->orderBy('nombre')
            ->get()
            ->map(fn ($m) => CategoriaIndicadorDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): CategoriaIndicadorDTO
    {
        $model = CategoriaIndicador::find($id);
        if (! $model) {
            throw new \RuntimeException("Categoría '{$id}' no encontrada.", 404);
        }

        return CategoriaIndicadorDTO::fromModel($model);
    }

    public function create(array $data): CategoriaIndicadorDTO
    {
        $model = CategoriaIndicador::create($data);

        return CategoriaIndicadorDTO::fromModel($model);
    }

    public function update(int $id, array $data): CategoriaIndicadorDTO
    {
        /** @var CategoriaIndicador $model */
        $model = CategoriaIndicador::find($id);
        if (! $model) {
            throw new \RuntimeException("Categoría '{$id}' no encontrada.", 404);
        }
        $model->update($data);

        return CategoriaIndicadorDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return CategoriaIndicador::destroy($ids) > 0;
    }
}
