<?php

namespace App\Application\TramitesCatalogo\QueryHandlers;

use App\Application\TramitesCatalogo\Queries\GetTramitesQuery;
use App\Domain\TramitesCatalogo\Contracts\TramiteRepositoryInterface;

class GetTramitesQueryHandler
{
    public function __construct(private readonly TramiteRepositoryInterface $repository) {}

    public function handle(GetTramitesQuery $query): array
    {
        return $this->repository->paginate($query->pagination, $query->soloActivos, $query->tipoTramiteId);
    }
}
