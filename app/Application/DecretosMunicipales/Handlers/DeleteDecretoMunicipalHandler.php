<?php

namespace App\Application\DecretosMunicipales\Handlers;

use App\Application\DecretosMunicipales\Commands\DeleteDecretoMunicipalCommand;
use App\Domain\DecretosMunicipales\Contracts\DecretoMunicipalRepositoryInterface;
use App\Domain\DecretosMunicipales\Exceptions\DecretoMunicipalNotFoundException;

class DeleteDecretoMunicipalHandler
{
    public function __construct(
        private readonly DecretoMunicipalRepositoryInterface $repository
    ) {}

    public function handle(DeleteDecretoMunicipalCommand $command): void
    {
        $deleted = $this->repository->delete($command->id);
        if (! $deleted) {
            throw new DecretoMunicipalNotFoundException($command->id);
        }
    }
}
