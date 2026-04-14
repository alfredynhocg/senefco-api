<?php

namespace App\Application\PartidasPresupuestarias\QueryHandlers;

use App\Application\PartidasPresupuestarias\Queries\GetPartidasByPresupuestoQuery;
use App\Domain\PartidasPresupuestarias\Contracts\PartidaPresupuestariaRepositoryInterface;

class GetPartidasByPresupuestoQueryHandler
{
    public function __construct(private readonly PartidaPresupuestariaRepositoryInterface $repository) {}

    public function handle(GetPartidasByPresupuestoQuery $query): array
    {
        return $this->repository->findByPresupuesto($query->presupuestoId);
    }
}
