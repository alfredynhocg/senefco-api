<?php

namespace App\Application\Subcenefcos\Handlers;

use App\Application\Subcenefcos\Commands\UpdateSubcenefcoCommand;
use App\Application\Subcenefcos\DTOs\SubcenefcoDTO;
use App\Domain\Subcenefcos\Contracts\SubcenefcoRepositoryInterface;

class UpdateSubcenefcoHandler
{
    public function __construct(private readonly SubcenefcoRepositoryInterface $repository) {}

    public function handle(UpdateSubcenefcoCommand $command): SubcenefcoDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
