<?php

namespace App\Application\TramitesCatalogo\Handlers;

use App\Application\TramitesCatalogo\Commands\DeleteTramiteCommand;
use App\Domain\TramitesCatalogo\Contracts\TramiteRepositoryInterface;

class DeleteTramiteHandler
{
    public function __construct(private readonly TramiteRepositoryInterface $repository) {}

    public function handle(DeleteTramiteCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
