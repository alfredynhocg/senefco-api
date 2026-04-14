<?php

namespace App\Application\EstadosProyecto\QueryHandlers;

use App\Application\EstadosProyecto\Queries\GetAllEstadosProyectoQuery;
use App\Domain\EstadosProyecto\Contracts\EstadoProyectoRepositoryInterface;

class GetAllEstadosProyectoQueryHandler
{
    public function __construct(private readonly EstadoProyectoRepositoryInterface $repository) {}

    public function handle(GetAllEstadosProyectoQuery $query): array
    {
        return $this->repository->all();
    }
}
