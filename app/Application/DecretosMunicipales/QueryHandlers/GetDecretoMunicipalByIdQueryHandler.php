<?php

namespace App\Application\DecretosMunicipales\QueryHandlers;

use App\Application\DecretosMunicipales\DTOs\DecretoMunicipalDTO;
use App\Application\DecretosMunicipales\Queries\GetDecretoMunicipalByIdQuery;
use App\Domain\DecretosMunicipales\Contracts\DecretoMunicipalRepositoryInterface;

class GetDecretoMunicipalByIdQueryHandler
{
    public function __construct(
        private readonly DecretoMunicipalRepositoryInterface $repository
    ) {}

    public function handle(GetDecretoMunicipalByIdQuery $query): DecretoMunicipalDTO
    {
        return $this->repository->findById($query->id);
    }
}
