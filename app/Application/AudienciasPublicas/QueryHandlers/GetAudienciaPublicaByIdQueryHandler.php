<?php

namespace App\Application\AudienciasPublicas\QueryHandlers;

use App\Application\AudienciasPublicas\Queries\GetAudienciaPublicaByIdQuery;
use App\Domain\AudienciasPublicas\Contracts\AudienciaPublicaRepositoryInterface;

class GetAudienciaPublicaByIdQueryHandler
{
    public function __construct(
        private readonly AudienciaPublicaRepositoryInterface $repository
    ) {}

    public function handle(GetAudienciaPublicaByIdQuery $query): mixed
    {
        return $this->repository->findById($query->id);
    }
}
