<?php

namespace App\Application\PortalIndicadores\Handlers;

use App\Application\PortalIndicadores\Commands\UpdatePortalIndicadorCommand;
use App\Application\PortalIndicadores\DTOs\PortalIndicadorDTO;
use App\Domain\PortalIndicadores\Contracts\PortalIndicadorRepositoryInterface;

class UpdatePortalIndicadorHandler
{
    public function __construct(private readonly PortalIndicadorRepositoryInterface $repository) {}

    public function handle(UpdatePortalIndicadorCommand $command): PortalIndicadorDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
