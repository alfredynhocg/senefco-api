<?php

namespace App\Application\AvanceProyecto\QueryHandlers;

use App\Application\AvanceProyecto\Queries\GetAvancesByProyectoQuery;
use App\Domain\AvanceProyecto\Contracts\AvanceProyectoRepositoryInterface;

class GetAvancesByProyectoQueryHandler
{
    public function __construct(private readonly AvanceProyectoRepositoryInterface $repository) {}

    public function handle(GetAvancesByProyectoQuery $query): array
    {
        return $this->repository->findByProyecto($query->proyectoId);
    }
}
