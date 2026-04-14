<?php

namespace App\Application\ContactosMunicipales\QueryHandlers;

use App\Application\ContactosMunicipales\Queries\GetContactosMunicipalesQuery;
use App\Domain\ContactosMunicipales\Contracts\ContactoMunicipalRepositoryInterface;

class GetContactosMunicipalesQueryHandler
{
    public function __construct(private readonly ContactoMunicipalRepositoryInterface $repository) {}

    public function handle(GetContactosMunicipalesQuery $query): array
    {
        return $this->repository->paginate($query->pagination);
    }
}
