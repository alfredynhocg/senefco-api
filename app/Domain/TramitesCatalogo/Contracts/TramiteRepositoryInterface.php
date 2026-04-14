<?php

namespace App\Domain\TramitesCatalogo\Contracts;

use App\Shared\Kernel\DTOs\PaginationDTO;

interface TramiteRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloActivos = false, ?int $tipoTramiteId = null): array;

    public function findById(int $id): mixed;

    public function findBySlug(string $slug): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
