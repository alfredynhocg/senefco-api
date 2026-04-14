<?php

namespace App\Application\Presupuestos\QueryHandlers;

use App\Application\Presupuestos\Queries\GetAllPresupuestosQuery;
use App\Domain\Presupuestos\Contracts\PresupuestoRepositoryInterface;

class GetAllPresupuestosQueryHandler
{
    public function __construct(private readonly PresupuestoRepositoryInterface $repository) {}

    public function handle(GetAllPresupuestosQuery $query): array
    {
        return $this->repository->all();
    }
}
