<?php

namespace App\Application\ConsultasCiudadanas\Handlers;

use App\Application\ConsultasCiudadanas\Commands\ResponderConsultaCommand;
use App\Application\ConsultasCiudadanas\DTOs\ConsultaCiudadanaDTO;
use App\Domain\ConsultasCiudadanas\Contracts\ConsultaCiudadanaRepositoryInterface;

class ResponderConsultaHandler
{
    public function __construct(
        private readonly ConsultaCiudadanaRepositoryInterface $repository
    ) {}

    public function handle(ResponderConsultaCommand $command): ConsultaCiudadanaDTO
    {
        return $this->repository->responder($command->id, [
            'respuesta' => $command->respuesta,
            'estado' => $command->estado,
            'respondido_por' => auth()->user()?->name,
            'respondido_at' => now(),
        ]);
    }
}
