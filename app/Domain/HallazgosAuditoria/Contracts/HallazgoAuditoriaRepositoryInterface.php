<?php

namespace App\Domain\HallazgosAuditoria\Contracts;

interface HallazgoAuditoriaRepositoryInterface
{
    public function findByAuditoria(int $auditoriaId): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
