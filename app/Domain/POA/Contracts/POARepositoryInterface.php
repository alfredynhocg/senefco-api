<?php

namespace App\Domain\POA\Contracts;

interface POARepositoryInterface
{
    public function findByGestion(int $gestion): mixed;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;

    public function all(): array;
}
