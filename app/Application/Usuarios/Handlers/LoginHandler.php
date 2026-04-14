<?php

namespace App\Application\Usuarios\Handlers;

use App\Application\Usuarios\Commands\LoginCommand;
use App\Application\Usuarios\DTOs\UserDTO;
use App\Infrastructure\Usuarios\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginHandler
{
    public function handle(LoginCommand $command): array
    {
        $user = User::with('roles')->where('email', $command->email)->first();

        if (! $user || ! Hash::check($command->password, $user->password_hash)) {
            throw new \RuntimeException('Credenciales incorrectas.');
        }

        if (! $user->activo) {
            throw new \RuntimeException('Tu cuenta está desactivada.');
        }

        $user->tokens()->where('name', $command->deviceName)->delete();

        $token = $user->createToken($command->deviceName)->plainTextToken;

        return [
            'token' => $token,
            'user' => UserDTO::fromModel($user),
        ];
    }
}
