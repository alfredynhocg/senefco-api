<?php

namespace App\Application\Proyectos\QueryHandlers;

use App\Application\Proyectos\Queries\GetProyectosQuery;
use App\Domain\Proyectos\Contracts\ProyectoRepositoryInterface;

class GetProyectosQueryHandler
{
    public function __construct(private readonly ProyectoRepositoryInterface $repository) {}

    public function handle(GetProyectosQuery $query): array
    {
        return $this->repository->all($query->filters);
    }
}
