<?php

namespace App\Application\ManualesInstitucionales\Handlers;

use App\Application\ManualesInstitucionales\Commands\UpdateManualInstitucionalCommand;
use App\Application\ManualesInstitucionales\DTOs\ManualInstitucionalDTO;
use App\Domain\ManualesInstitucionales\Contracts\ManualInstitucionalRepositoryInterface;

class UpdateManualInstitucionalHandler
{
    public function __construct(private readonly ManualInstitucionalRepositoryInterface $repository) {}

    public function handle(UpdateManualInstitucionalCommand $command): ManualInstitucionalDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
