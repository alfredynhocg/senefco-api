<?php

namespace App\Application\Usuarios\Handlers;

use App\Application\Usuarios\Commands\RegisterUserCommand;
use App\Application\Usuarios\DTOs\UserDTO;
use App\Domain\Usuarios\Contracts\UserRepositoryInterface;
use App\Infrastructure\Usuarios\Models\Role;
use App\Infrastructure\Usuarios\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class RegisterUserHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {}

    public function handle(RegisterUserCommand $command): UserDTO
    {
        $rolId = $command->roleId
            ?? Role::where('nombre', 'Ciudadano')->value('id');

        $userDTO = $this->userRepository->create([
            'nombre' => $command->nombre,
            'apellido' => $command->apellido,
            'email' => $command->email,
            'password_hash' => Hash::make($command->password),
            'tipo' => 'ciudadano',
            'activo' => true,
            'email_verificado' => false,
            'rol_id' => $rolId,
        ]);

        $user = User::find($userDTO->id);
        event(new Registered($user));

        return $userDTO;
    }
}
