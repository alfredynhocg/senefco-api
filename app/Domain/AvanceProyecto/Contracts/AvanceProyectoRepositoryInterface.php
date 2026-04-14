<?php

namespace App\Domain\AvanceProyecto\Contracts;

interface AvanceProyectoRepositoryInterface
{
    public function findByProyecto(int $proyectoId): array;

    public function create(array $data): mixed;

    public function delete(int|array $ids): bool;
}
