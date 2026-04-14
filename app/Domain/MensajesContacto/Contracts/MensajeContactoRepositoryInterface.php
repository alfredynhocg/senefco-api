<?php

namespace App\Domain\MensajesContacto\Contracts;

use App\Shared\Kernel\DTOs\PaginationDTO;

interface MensajeContactoRepositoryInterface
{
    public function paginate(PaginationDTO $pagination): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
