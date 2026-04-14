<?php

namespace App\Application\DecretosMunicipales\Handlers;

use App\Application\DecretosMunicipales\Commands\UpdateDecretoMunicipalCommand;
use App\Application\DecretosMunicipales\DTOs\DecretoMunicipalDTO;
use App\Domain\DecretosMunicipales\Contracts\DecretoMunicipalRepositoryInterface;

class UpdateDecretoMunicipalHandler
{
    public function __construct(
        private readonly DecretoMunicipalRepositoryInterface $repository
    ) {}

    public function handle(UpdateDecretoMunicipalCommand $command): DecretoMunicipalDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
