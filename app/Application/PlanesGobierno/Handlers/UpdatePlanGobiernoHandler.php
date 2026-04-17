<?php

namespace App\Application\PlanesGobierno\Handlers;

use App\Application\PlanesGobierno\Commands\UpdatePlanGobiernoCommand;
use App\Application\PlanesGobierno\DTOs\PlanGobiernoDTO;
use App\Domain\PlanesGobierno\Contracts\PlanGobiernoRepositoryInterface;

class UpdatePlanGobiernoHandler
{
    public function __construct(private readonly PlanGobiernoRepositoryInterface $repository) {}

    public function handle(UpdatePlanGobiernoCommand $command): PlanGobiernoDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
