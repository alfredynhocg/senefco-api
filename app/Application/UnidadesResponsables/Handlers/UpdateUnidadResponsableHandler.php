<?php

namespace App\Application\UnidadesResponsables\Handlers;

use App\Application\UnidadesResponsables\Commands\UpdateUnidadResponsableCommand;
use App\Application\UnidadesResponsables\DTOs\UnidadResponsableDTO;
use App\Domain\UnidadesResponsables\Contracts\UnidadResponsableRepositoryInterface;

class UpdateUnidadResponsableHandler
{
    public function __construct(private readonly UnidadResponsableRepositoryInterface $repository) {}

    public function handle(UpdateUnidadResponsableCommand $command): UnidadResponsableDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
