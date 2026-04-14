<?php

namespace App\Domain\Usuarios\Contracts;

interface RoleRepositoryInterface
{
    public function all(): array;

    public function findById(int $id): array;

    public function create(array $data): array;

    public function update(int $id, array $data): array;

    public function delete(int $id): void;
}
