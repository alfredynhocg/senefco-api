<?php

namespace App\Application\TiposTramite\Handlers;

use App\Application\TiposTramite\Commands\UpdateTipoTramiteCommand;
use App\Application\TiposTramite\DTOs\TipoTramiteDTO;
use App\Domain\TiposTramite\Contracts\TipoTramiteRepositoryInterface;

class UpdateTipoTramiteHandler
{
    public function __construct(private readonly TipoTramiteRepositoryInterface $repository) {}

    public function handle(UpdateTipoTramiteCommand $command): TipoTramiteDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
