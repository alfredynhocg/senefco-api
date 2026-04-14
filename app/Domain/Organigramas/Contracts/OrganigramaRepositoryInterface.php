<?php

namespace App\Domain\Organigramas\Contracts;

interface OrganigramaRepositoryInterface
{
    public function findLatest(): mixed;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;

    public function all(): array;
}
