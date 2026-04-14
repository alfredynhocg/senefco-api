<?php

namespace App\Domain\Ajustes\Contracts;

interface AjusteRepositoryInterface
{
    public function all(): array;

    public function findByKey(string $key): mixed;

    public function update(string $key, array $data): mixed;

    public function create(array $data): mixed;
}
