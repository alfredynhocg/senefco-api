<?php

namespace App\Domain\TiposNorma\Contracts;

interface TipoNormaRepositoryInterface
{
    public function all(): array;

    public function findById(int $id): mixed;

    public function findBySlug(string $slug): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
