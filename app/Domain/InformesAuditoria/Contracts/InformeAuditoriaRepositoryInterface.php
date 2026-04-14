<?php

namespace App\Domain\InformesAuditoria\Contracts;

use App\Shared\Kernel\DTOs\PaginationDTO;

interface InformeAuditoriaRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloPublicados = false): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
