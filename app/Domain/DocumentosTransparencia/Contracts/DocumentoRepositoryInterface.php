<?php

namespace App\Domain\DocumentosTransparencia\Contracts;

use App\Shared\Kernel\DTOs\PaginationDTO;

interface DocumentoRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloActivos = false): array;

    public function findById(int $id): mixed;

    public function findBySlug(string $slug): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
