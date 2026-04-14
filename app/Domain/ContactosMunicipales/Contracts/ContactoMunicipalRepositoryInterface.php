<?php

namespace App\Domain\ContactosMunicipales\Contracts;

use App\Shared\Kernel\DTOs\PaginationDTO;

interface ContactoMunicipalRepositoryInterface
{
    public function paginate(PaginationDTO $pagination): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
