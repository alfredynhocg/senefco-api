<?php

namespace App\Application\DecretosMunicipales\QueryHandlers;

use App\Application\DecretosMunicipales\Queries\GetDecretosMunicipalesQuery;
use App\Domain\DecretosMunicipales\Contracts\DecretoMunicipalRepositoryInterface;

class GetDecretosMunicipalesQueryHandler
{
    public function __construct(
        private readonly DecretoMunicipalRepositoryInterface $repository
    ) {}

    public function handle(GetDecretosMunicipalesQuery $query): array
    {
        return $this->repository->paginate($query->pagination, $query->soloPublicados, $query->tipo);
    }
}
