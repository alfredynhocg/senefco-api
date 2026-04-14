<?php

namespace App\Application\EjecucionPresupuestaria\QueryHandlers;

use App\Application\EjecucionPresupuestaria\Queries\GetEjecucionByPresupuestoQuery;
use App\Domain\EjecucionPresupuestaria\Contracts\EjecucionPresupuestariaRepositoryInterface;

class GetEjecucionByPresupuestoQueryHandler
{
    public function __construct(private readonly EjecucionPresupuestariaRepositoryInterface $repository) {}

    public function handle(GetEjecucionByPresupuestoQuery $query): array
    {
        return $this->repository->findByPresupuesto($query->presupuestoId);
    }
}
