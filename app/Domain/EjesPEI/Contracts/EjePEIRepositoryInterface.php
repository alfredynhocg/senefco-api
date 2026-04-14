<?php

namespace App\Domain\EjesPEI\Contracts;

interface EjePEIRepositoryInterface
{
    public function findByPei(int $peiId): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
