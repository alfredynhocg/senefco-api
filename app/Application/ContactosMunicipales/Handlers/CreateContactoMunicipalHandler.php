<?php

namespace App\Application\ContactosMunicipales\Handlers;

use App\Application\ContactosMunicipales\Commands\CreateContactoMunicipalCommand;
use App\Application\ContactosMunicipales\DTOs\ContactoMunicipalDTO;
use App\Domain\ContactosMunicipales\Contracts\ContactoMunicipalRepositoryInterface;

class CreateContactoMunicipalHandler
{
    public function __construct(private readonly ContactoMunicipalRepositoryInterface $repository) {}

    public function handle(CreateContactoMunicipalCommand $command): ContactoMunicipalDTO
    {
        return $this->repository->create([
            'nombre_area' => $command->nombre_area,
            'telefono' => $command->telefono,
            'interno' => $command->interno,
            'encargado' => $command->encargado,
            'orden' => $command->orden,
            'activo' => $command->activo,
        ]);
    }
}
