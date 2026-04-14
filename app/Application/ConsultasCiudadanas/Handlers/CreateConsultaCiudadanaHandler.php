<?php

namespace App\Application\ConsultasCiudadanas\Handlers;

use App\Application\ConsultasCiudadanas\Commands\CreateConsultaCiudadanaCommand;
use App\Application\ConsultasCiudadanas\DTOs\ConsultaCiudadanaDTO;
use App\Domain\ConsultasCiudadanas\Contracts\ConsultaCiudadanaRepositoryInterface;

class CreateConsultaCiudadanaHandler
{
    public function __construct(
        private readonly ConsultaCiudadanaRepositoryInterface $repository
    ) {}

    public function handle(CreateConsultaCiudadanaCommand $command): ConsultaCiudadanaDTO
    {
        return $this->repository->create([
            'ciudadano_nombre' => $command->ciudadano_nombre,
            'ciudadano_ci' => $command->ciudadano_ci,
            'ciudadano_email' => $command->ciudadano_email,
            'ciudadano_telefono' => $command->ciudadano_telefono,
            'tipo' => $command->tipo,
            'asunto' => $command->asunto,
            'descripcion' => $command->descripcion,
            'estado' => $command->estado,
        ]);
    }
}
