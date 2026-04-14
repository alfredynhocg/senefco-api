<?php

namespace App\Domain\DirectorioInstitucional\Contracts;

interface DirectorioInstitucionalRepositoryInterface
{
    public function paginate(int $pageIndex, int $pageSize, string $query, string $activo): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int $id): bool;
}
