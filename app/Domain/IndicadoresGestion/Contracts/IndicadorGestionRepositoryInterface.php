<?php

namespace App\Domain\IndicadoresGestion\Contracts;

interface IndicadorGestionRepositoryInterface
{
    public function all(array $filters = []): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
