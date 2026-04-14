<?php

namespace App\Application\Etiquetas\Handlers;

use App\Application\Etiquetas\Commands\UpdateEtiquetaCommand;
use App\Application\Etiquetas\DTOs\EtiquetaDTO;
use App\Domain\Etiquetas\Contracts\EtiquetaRepositoryInterface;

class UpdateEtiquetaHandler
{
    public function __construct(private readonly EtiquetaRepositoryInterface $repository) {}

    public function handle(UpdateEtiquetaCommand $command): EtiquetaDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
