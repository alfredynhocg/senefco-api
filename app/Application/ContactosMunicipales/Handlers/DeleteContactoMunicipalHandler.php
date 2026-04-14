<?php

namespace App\Application\ContactosMunicipales\Handlers;

use App\Application\ContactosMunicipales\Commands\DeleteContactoMunicipalCommand;
use App\Domain\ContactosMunicipales\Contracts\ContactoMunicipalRepositoryInterface;

class DeleteContactoMunicipalHandler
{
    public function __construct(private readonly ContactoMunicipalRepositoryInterface $repository) {}

    public function handle(DeleteContactoMunicipalCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
