<?php

namespace App\Domain\ValoresIndicador\Contracts;

interface ValorIndicadorRepositoryInterface
{
    public function findByIndicador(int $indicadorId): array;

    public function create(array $data): mixed;

    public function delete(int|array $ids): bool;
}
