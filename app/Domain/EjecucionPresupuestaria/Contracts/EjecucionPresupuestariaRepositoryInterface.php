<?php

namespace App\Domain\EjecucionPresupuestaria\Contracts;

interface EjecucionPresupuestariaRepositoryInterface
{
    public function findByPresupuesto(int $presupuestoId): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
