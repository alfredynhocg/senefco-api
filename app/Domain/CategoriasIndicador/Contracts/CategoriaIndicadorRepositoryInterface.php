<?php

namespace App\Domain\CategoriasIndicador\Contracts;

interface CategoriaIndicadorRepositoryInterface
{
    public function all(): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
