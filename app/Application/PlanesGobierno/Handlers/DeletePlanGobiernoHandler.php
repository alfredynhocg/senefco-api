<?php

namespace App\Application\PlanesGobierno\Handlers;

use App\Application\PlanesGobierno\Commands\DeletePlanGobiernoCommand;
use App\Domain\PlanesGobierno\Contracts\PlanGobiernoRepositoryInterface;

class DeletePlanGobiernoHandler
{
    public function __construct(private readonly PlanGobiernoRepositoryInterface $repository) {}

    public function handle(DeletePlanGobiernoCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
