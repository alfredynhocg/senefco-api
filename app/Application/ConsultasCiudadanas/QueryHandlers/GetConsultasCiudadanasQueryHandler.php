<?php

namespace App\Application\ConsultasCiudadanas\QueryHandlers;

use App\Application\ConsultasCiudadanas\Queries\GetConsultasCiudadanasQuery;
use App\Domain\ConsultasCiudadanas\Contracts\ConsultaCiudadanaRepositoryInterface;

class GetConsultasCiudadanasQueryHandler
{
    public function __construct(
        private readonly ConsultaCiudadanaRepositoryInterface $repository
    ) {}

    public function handle(GetConsultasCiudadanasQuery $query): array
    {
        return $this->repository->paginate(
            $query->pageIndex,
            $query->pageSize,
            $query->query,
            $query->tipo,
            $query->estado,
        );
    }
}
