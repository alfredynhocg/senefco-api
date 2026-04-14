<?php

namespace App\Infrastructure\Usuarios\Repositories;

use App\Domain\Usuarios\Contracts\RoleRepositoryInterface;
use App\Infrastructure\Usuarios\Models\Role;

class EloquentRoleRepository implements RoleRepositoryInterface
{
    public function all(): array
    {
        return Role::where('activo', true)->get()->toArray();
    }

    public function findById(int $id): array
    {
        return Role::findOrFail($id)->toArray();
    }

    public function create(array $data): array
    {
        return Role::create($data)->toArray();
    }

    public function update(int $id, array $data): array
    {
        $role = Role::findOrFail($id);
        $role->update($data);

        return $role->fresh()->toArray();
    }

    public function delete(int $id): void
    {
        Role::findOrFail($id)->delete();
    }
}
