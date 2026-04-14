<?php

namespace App\Domain\Comunicados\Contracts;

interface ComunicadoRepositoryInterface
{
    public function paginate(array $filters = []): array;

    public function findById(int $id): mixed;

    public function findBySlug(string $slug): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int $id): bool;
}
