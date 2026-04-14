<?php

namespace App\Domain\Usuarios\Contracts;

use App\Application\Usuarios\DTOs\UserDTO;
use App\Shared\Kernel\DTOs\PaginationDTO;

interface UserRepositoryInterface
{
    public function findById(int $id): UserDTO;

    public function findByEmail(string $email): ?UserDTO;

    public function paginate(PaginationDTO $pagination): array;

    public function create(array $data): UserDTO;

    public function update(int $id, array $data): UserDTO;

    public function delete(int $id): void;
}
