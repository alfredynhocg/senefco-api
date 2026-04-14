<?php

namespace App\Domain\PortalIndicadores\Contracts;

use App\Shared\Kernel\DTOs\PaginationDTO;

interface PortalIndicadorRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, ?string $categoria, ?string $estado): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
