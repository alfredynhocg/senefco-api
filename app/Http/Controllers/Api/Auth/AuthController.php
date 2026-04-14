<?php

namespace App\Http\Controllers\Api\Auth;

use App\Application\Usuarios\Commands\ForgotPasswordCommand;
use App\Application\Usuarios\Commands\LoginCommand;
use App\Application\Usuarios\Commands\RegisterUserCommand;
use App\Application\Usuarios\Commands\ResetPasswordCommand;
use App\Application\Usuarios\DTOs\UserDTO;
use App\Application\Usuarios\Handlers\ForgotPasswordHandler;
use App\Application\Usuarios\Handlers\LoginHandler;
use App\Application\Usuarios\Handlers\RegisterUserHandler;
use App\Application\Usuarios\Handlers\ResetPasswordHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Usuarios\ForgotPasswordRequest;
use App\Http\Requests\Usuarios\LoginRequest;
use App\Http\Requests\Usuarios\RegisterUserRequest;
use App\Http\Requests\Usuarios\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private readonly LoginHandler $loginHandler,
        private readonly RegisterUserHandler $registerHandler,
        private readonly ForgotPasswordHandler $forgotPasswordHandler,
        private readonly ResetPasswordHandler $resetPasswordHandler,
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->loginHandler->handle(
                new LoginCommand(
                    email: $request->email,
                    password: $request->password,
                    deviceName: $request->header('User-Agent', 'web'),
                )
            );

            return response()->json([
                'token' => $result['token'],
                'user' => $result['user'],
            ]);
        } catch (\RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada.']);
    }

    public function logoutAll(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Todas las sesiones cerradas.']);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json(
            UserDTO::fromModel($request->user()->load('roles'))
        );
    }

    public function updatePerfil(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => 'sometimes|string|max:100',
            'apellido' => 'sometimes|string|max:100',
            'current_password' => 'required_with:password|string',
            'password' => 'sometimes|string|min:8|confirmed',
        ]);

        $user = $request->user();

        if (isset($data['password'])) {
            if (! Hash::check($data['current_password'], $user->password_hash)) {
                return response()->json(['error' => 'Contraseña actual incorrecta.'], 422);
            }
            $user->update(['password_hash' => Hash::make($data['password'])]);
            unset($data['password'], $data['current_password']);
        }

        $user->update(array_filter($data, fn ($v) => $v !== null));

        return response()->json(UserDTO::fromModel($user->fresh('roles')));
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        try {
            $userDTO = $this->registerHandler->handle(
                new RegisterUserCommand(
                    nombre: $request->nombre,
                    apellido: $request->apellido,
                    email: $request->email,
                    password: $request->password,
                    roleId: $request->rol_id,
                )
            );

            return response()->json($userDTO, 201);
        } catch (\RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        try {
            $this->forgotPasswordHandler->handle(
                new ForgotPasswordCommand($request->email)
            );

            return response()->json(['message' => 'Te enviamos un enlace de recuperación a tu correo.']);
        } catch (\RuntimeException $e) {
            return response()->json(['error' => 'No encontramos una cuenta con ese correo electrónico.'], 404);
        }
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        try {
            $this->resetPasswordHandler->handle(new ResetPasswordCommand(
                email: $request->email,
                password: $request->password,
                passwordConfirmation: $request->password_confirmation,
                token: $request->token,
            ));

            return response()->json(['message' => 'Contraseña restablecida exitosamente.']);
        } catch (\RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
