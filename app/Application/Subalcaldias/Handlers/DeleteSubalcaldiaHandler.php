<?php

namespace App\Application\Subcenefcos\Handlers;

use App\Application\Subcenefcos\Commands\DeleteSubcenefcoCommand;
use App\Domain\Subcenefcos\Contracts\SubcenefcoRepositoryInterface;

class DeleteSubcenefcoHandler
{
    public function __construct(private readonly SubcenefcoRepositoryInterface $repository) {}

    public function handle(DeleteSubcenefcoCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
