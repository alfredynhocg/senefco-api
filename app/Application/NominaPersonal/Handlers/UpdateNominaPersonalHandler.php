<?php

namespace App\Application\NominaPersonal\Handlers;

use App\Application\NominaPersonal\Commands\UpdateNominaPersonalCommand;
use App\Application\NominaPersonal\DTOs\NominaPersonalDTO;
use App\Domain\NominaPersonal\Contracts\NominaPersonalRepositoryInterface;

class UpdateNominaPersonalHandler
{
    public function __construct(private readonly NominaPersonalRepositoryInterface $repository) {}

    public function handle(UpdateNominaPersonalCommand $command): NominaPersonalDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
