<?php

namespace App\Application\ConsultasCiudadanas\QueryHandlers;

use App\Application\ConsultasCiudadanas\DTOs\ConsultaCiudadanaDTO;
use App\Application\ConsultasCiudadanas\Queries\GetConsultaCiudadanaByIdQuery;
use App\Domain\ConsultasCiudadanas\Contracts\ConsultaCiudadanaRepositoryInterface;

class GetConsultaCiudadanaByIdQueryHandler
{
    public function __construct(
        private readonly ConsultaCiudadanaRepositoryInterface $repository
    ) {}

    public function handle(GetConsultaCiudadanaByIdQuery $query): ConsultaCiudadanaDTO
    {
        return $this->repository->findById($query->id);
    }
}
