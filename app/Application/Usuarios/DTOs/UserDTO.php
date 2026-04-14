<?php

namespace App\Application\Usuarios\DTOs;

use App\Infrastructure\Usuarios\Models\User;

class UserDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $nombre,
        public readonly string $apellido,
        public readonly string $email,
        public readonly string $tipo,
        public readonly bool $activo,
        public readonly bool $emailVerificado,
        public readonly ?int $rolId,
        public readonly ?string $rolNombre,
        public readonly ?array $permisos,
        public readonly string $createdAt,
    ) {}

    public static function fromModel(User $user): self
    {
        $rol = $user->roles->first();

        return new self(
            id: $user->id,
            nombre: $user->nombre,
            apellido: $user->apellido,
            email: $user->email,
            tipo: $user->tipo,
            activo: (bool) $user->activo,
            emailVerificado: (bool) $user->email_verificado,
            rolId: $rol?->id,
            rolNombre: $rol?->nombre,
            permisos: $rol?->permisos->pluck('codigo')->all() ?? [],
            createdAt: $user->created_at?->toIso8601String() ?? '',
        );
    }
}
