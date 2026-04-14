<?php

namespace App\Application\UnidadesResponsables\QueryHandlers;

use App\Application\UnidadesResponsables\Queries\GetUnidadesResponsablesQuery;
use App\Domain\UnidadesResponsables\Contracts\UnidadResponsableRepositoryInterface;

class GetUnidadesResponsablesQueryHandler
{
    public function __construct(private readonly UnidadResponsableRepositoryInterface $repository) {}

    public function handle(GetUnidadesResponsablesQuery $query): array
    {
        return $this->repository->paginate($query->pagination);
    }
}
