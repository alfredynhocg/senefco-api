<?php

namespace App\Application\UnidadesResponsables\Handlers;

use App\Application\UnidadesResponsables\Commands\DeleteUnidadResponsableCommand;
use App\Domain\UnidadesResponsables\Contracts\UnidadResponsableRepositoryInterface;

class DeleteUnidadResponsableHandler
{
    public function __construct(private readonly UnidadResponsableRepositoryInterface $repository) {}

    public function handle(DeleteUnidadResponsableCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
