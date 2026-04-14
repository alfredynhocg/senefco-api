<?php

namespace App\Application\Subsenefcos\Handlers;

use App\Application\Subsenefcos\Commands\CreateSubsenefcoCommand;
use App\Application\Subsenefcos\DTOs\SubsenefcoDTO;
use App\Domain\Subsenefcos\Contracts\SubsenefcoRepositoryInterface;

class CreateSubsenefcoHandler
{
    public function __construct(private readonly SubsenefcoRepositoryInterface $repository) {}

    public function handle(CreateSubsenefcoCommand $command): SubsenefcoDTO
    {
        return $this->repository->create([
            'nombre' => $command->nombre,
            'zona_cobertura' => $command->zona_cobertura,
            'direccion_fisica' => $command->direccion_fisica,
            'telefono' => $command->telefono,
            'email' => $command->email,
            'imagen_url' => $command->imagen_url,
            'latitud' => $command->latitud,
            'longitud' => $command->longitud,
            'tramites_disponibles' => $command->tramites_disponibles,
            'activa' => $command->activa,
        ]);
    }
}
