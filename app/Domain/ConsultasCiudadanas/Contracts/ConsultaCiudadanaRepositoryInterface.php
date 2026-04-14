<?php

namespace App\Domain\ConsultasCiudadanas\Contracts;

interface ConsultaCiudadanaRepositoryInterface
{
    public function paginate(int $pageIndex, int $pageSize, string $query, string $tipo, string $estado): array;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function responder(int $id, array $data): mixed;

    public function delete(int $id): bool;
}
