<?php

namespace App\Application\ContactosMunicipales\Handlers;

use App\Application\ContactosMunicipales\Commands\UpdateContactoMunicipalCommand;
use App\Application\ContactosMunicipales\DTOs\ContactoMunicipalDTO;
use App\Domain\ContactosMunicipales\Contracts\ContactoMunicipalRepositoryInterface;

class UpdateContactoMunicipalHandler
{
    public function __construct(private readonly ContactoMunicipalRepositoryInterface $repository) {}

    public function handle(UpdateContactoMunicipalCommand $command): ContactoMunicipalDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
