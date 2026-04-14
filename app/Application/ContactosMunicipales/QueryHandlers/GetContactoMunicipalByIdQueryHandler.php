<?php

namespace App\Application\ContactosMunicipales\QueryHandlers;

use App\Application\ContactosMunicipales\DTOs\ContactoMunicipalDTO;
use App\Application\ContactosMunicipales\Queries\GetContactoMunicipalByIdQuery;
use App\Domain\ContactosMunicipales\Contracts\ContactoMunicipalRepositoryInterface;

class GetContactoMunicipalByIdQueryHandler
{
    public function __construct(private readonly ContactoMunicipalRepositoryInterface $repository) {}

    public function handle(GetContactoMunicipalByIdQuery $query): ContactoMunicipalDTO
    {
        return $this->repository->findById($query->id);
    }
}
