<?php

namespace App\Application\AudienciasPublicas\QueryHandlers;

use App\Application\AudienciasPublicas\Queries\GetAudienciasPublicasQuery;
use App\Domain\AudienciasPublicas\Contracts\AudienciaPublicaRepositoryInterface;

class GetAudienciasPublicasQueryHandler
{
    public function __construct(
        private readonly AudienciaPublicaRepositoryInterface $repository
    ) {}

    public function handle(GetAudienciasPublicasQuery $query): array
    {
        return $this->repository->paginate($query->pagination, $query->soloActivos);
    }
}
