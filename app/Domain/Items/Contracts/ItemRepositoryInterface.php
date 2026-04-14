<?php

namespace App\Domain\Items\Contracts;

use App\Shared\Kernel\DTOs\PaginationDTO;

interface ItemRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, ?string $tipo = null): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
