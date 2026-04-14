<?php

namespace App\Application\TiposTramite\Handlers;

use App\Application\TiposTramite\Commands\DeleteTipoTramiteCommand;
use App\Domain\TiposTramite\Contracts\TipoTramiteRepositoryInterface;

class DeleteTipoTramiteHandler
{
    public function __construct(private readonly TipoTramiteRepositoryInterface $repository) {}

    public function handle(DeleteTipoTramiteCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
