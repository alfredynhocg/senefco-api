<?php

namespace App\Application\TramitesCatalogo\Handlers;

use App\Application\TramitesCatalogo\Commands\UpdateTramiteCommand;
use App\Application\TramitesCatalogo\DTOs\TramiteDTO;
use App\Domain\TramitesCatalogo\Contracts\TramiteRepositoryInterface;

class UpdateTramiteHandler
{
    public function __construct(private readonly TramiteRepositoryInterface $repository) {}

    public function handle(UpdateTramiteCommand $command): TramiteDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
