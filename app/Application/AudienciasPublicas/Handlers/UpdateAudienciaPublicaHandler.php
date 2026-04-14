<?php

namespace App\Application\AudienciasPublicas\Handlers;

use App\Application\AudienciasPublicas\Commands\UpdateAudienciaPublicaCommand;
use App\Application\AudienciasPublicas\DTOs\AudienciaPublicaDTO;
use App\Domain\AudienciasPublicas\Contracts\AudienciaPublicaRepositoryInterface;

class UpdateAudienciaPublicaHandler
{
    public function __construct(
        private readonly AudienciaPublicaRepositoryInterface $repository
    ) {}

    public function handle(UpdateAudienciaPublicaCommand $command): AudienciaPublicaDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
