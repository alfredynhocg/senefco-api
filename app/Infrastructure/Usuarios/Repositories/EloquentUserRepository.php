<?php

namespace App\Infrastructure\Usuarios\Repositories;

use App\Application\Usuarios\DTOs\UserDTO;
use App\Domain\Usuarios\Contracts\UserRepositoryInterface;
use App\Domain\Usuarios\Exceptions\EmailDuplicadoException;
use App\Domain\Usuarios\Exceptions\UserNotFoundException;
use App\Infrastructure\Usuarios\Models\User;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findById(int $id): UserDTO
    {
        $user = User::with('roles')->find($id);

        if (! $user) {
            throw new UserNotFoundException($id);
        }

        return UserDTO::fromModel($user);
    }

    public function findByEmail(string $email): ?UserDTO
    {
        $user = User::with('roles')->where('email', $email)->first();

        return $user ? UserDTO::fromModel($user) : null;
    }

    public function paginate(PaginationDTO $pagination): array
    {
        $q = User::with('roles');

        if ($pagination->query) {
            $search = $pagination->query;
            $q->where(fn ($sub) => $sub
                ->where('nombre', 'like', "%{$search}%")
                ->orWhere('apellido', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
            );
        }

        $paginated = $q->orderByDesc('created_at')
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($u) => UserDTO::fromModel($u))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function create(array $data): UserDTO
    {
        if (User::where('email', $data['email'])->exists()) {
            throw new EmailDuplicadoException($data['email']);
        }

        $rolId = $data['rol_id'] ?? null;
        unset($data['rol_id']);

        $user = User::create($data);

        if ($rolId) {
            $user->roles()->attach($rolId, [
                'asignado_at' => now(),
                'asignado_por' => $user->id,
            ]);
        }

        return UserDTO::fromModel($user->load('roles'));
    }

    public function update(int $id, array $data): UserDTO
    {
        $user = User::with('roles')->find($id);

        if (! $user) {
            throw new UserNotFoundException($id);
        }

        if (isset($data['email']) && $data['email'] !== $user->email) {
            if (User::where('email', $data['email'])->exists()) {
                throw new EmailDuplicadoException($data['email']);
            }
        }

        $rolId = $data['rol_id'] ?? null;
        unset($data['rol_id']);

        $user->update($data);

        if ($rolId) {
            $user->roles()->sync([$rolId => [
                'asignado_at' => now(),
                'asignado_por' => auth()->id() ?? $id,
            ]]);
        }

        return UserDTO::fromModel($user->fresh('roles'));
    }

    public function delete(int $id): void
    {
        $user = User::find($id);

        if (! $user) {
            throw new UserNotFoundException($id);
        }

        $user->tokens()->delete();
        $user->delete();
    }
}
