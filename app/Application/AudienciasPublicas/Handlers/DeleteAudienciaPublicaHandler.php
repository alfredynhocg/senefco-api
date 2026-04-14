<?php

namespace App\Application\AudienciasPublicas\Handlers;

use App\Application\AudienciasPublicas\Commands\DeleteAudienciaPublicaCommand;
use App\Domain\AudienciasPublicas\Contracts\AudienciaPublicaRepositoryInterface;

class DeleteAudienciaPublicaHandler
{
    public function __construct(
        private readonly AudienciaPublicaRepositoryInterface $repository
    ) {}

    public function handle(DeleteAudienciaPublicaCommand $command): void
    {
        $this->repository->delete($command->id);
    }
}
