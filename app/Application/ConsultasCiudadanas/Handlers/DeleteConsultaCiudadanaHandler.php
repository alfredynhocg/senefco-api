<?php

namespace App\Application\ConsultasCiudadanas\Handlers;

use App\Application\ConsultasCiudadanas\Commands\DeleteConsultaCiudadanaCommand;
use App\Domain\ConsultasCiudadanas\Contracts\ConsultaCiudadanaRepositoryInterface;

class DeleteConsultaCiudadanaHandler
{
    public function __construct(
        private readonly ConsultaCiudadanaRepositoryInterface $repository
    ) {}

    public function handle(DeleteConsultaCiudadanaCommand $command): void
    {
        $this->repository->delete($command->id);
    }
}
