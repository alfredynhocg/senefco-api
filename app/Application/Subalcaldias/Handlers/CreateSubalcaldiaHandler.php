<?php

namespace App\Application\Subcenefcos\Handlers;

use App\Application\Subcenefcos\Commands\CreateSubcenefcoCommand;
use App\Application\Subcenefcos\DTOs\SubcenefcoDTO;
use App\Domain\Subcenefcos\Contracts\SubcenefcoRepositoryInterface;

class CreateSubcenefcoHandler
{
    public function __construct(private readonly SubcenefcoRepositoryInterface $repository) {}

    public function handle(CreateSubcenefcoCommand $command): SubcenefcoDTO
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
