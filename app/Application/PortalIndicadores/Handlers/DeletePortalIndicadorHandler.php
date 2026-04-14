<?php

namespace App\Application\PortalIndicadores\Handlers;

use App\Application\PortalIndicadores\Commands\DeletePortalIndicadorCommand;
use App\Domain\PortalIndicadores\Contracts\PortalIndicadorRepositoryInterface;

class DeletePortalIndicadorHandler
{
    public function __construct(private readonly PortalIndicadorRepositoryInterface $repository) {}

    public function handle(DeletePortalIndicadorCommand $command): void
    {
        $this->repository->delete($command->id);
    }
}
