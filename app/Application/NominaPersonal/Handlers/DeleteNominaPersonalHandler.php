<?php

namespace App\Application\NominaPersonal\Handlers;

use App\Application\NominaPersonal\Commands\DeleteNominaPersonalCommand;
use App\Domain\NominaPersonal\Contracts\NominaPersonalRepositoryInterface;

class DeleteNominaPersonalHandler
{
    public function __construct(private readonly NominaPersonalRepositoryInterface $repository) {}

    public function handle(DeleteNominaPersonalCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
