<?php

namespace App\Application\ManualesInstitucionales\Handlers;

use App\Application\ManualesInstitucionales\Commands\DeleteManualInstitucionalCommand;
use App\Domain\ManualesInstitucionales\Contracts\ManualInstitucionalRepositoryInterface;

class DeleteManualInstitucionalHandler
{
    public function __construct(private readonly ManualInstitucionalRepositoryInterface $repository) {}

    public function handle(DeleteManualInstitucionalCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
