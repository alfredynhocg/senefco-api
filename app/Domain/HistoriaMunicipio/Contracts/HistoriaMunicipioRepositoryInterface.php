<?php

namespace App\Domain\HistoriaMunicipio\Contracts;

use App\Shared\Kernel\DTOs\PaginationDTO;

interface HistoriaMunicipioRepositoryInterface
{
    public function paginate(PaginationDTO $pagination): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
