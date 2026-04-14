<?php

namespace App\Domain\EventosFotos\Contracts;

interface EventoFotoRepositoryInterface
{
    public function findByEvento(int $eventoId): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;
}
