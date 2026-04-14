<?php

namespace App\Application\UnidadesResponsables\QueryHandlers;

use App\Application\UnidadesResponsables\DTOs\UnidadResponsableDTO;
use App\Application\UnidadesResponsables\Queries\GetUnidadResponsableByIdQuery;
use App\Domain\UnidadesResponsables\Contracts\UnidadResponsableRepositoryInterface;

class GetUnidadResponsableByIdQueryHandler
{
    public function __construct(private readonly UnidadResponsableRepositoryInterface $repository) {}

    public function handle(GetUnidadResponsableByIdQuery $query): UnidadResponsableDTO
    {
        return $this->repository->findById($query->id);
    }
}
