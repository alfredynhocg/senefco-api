<?php

namespace App\Application\PlanesGobierno\QueryHandlers;

use App\Application\PlanesGobierno\Queries\GetAllPlanesGobiernoQuery;
use App\Domain\PlanesGobierno\Contracts\PlanGobiernoRepositoryInterface;

class GetAllPlanesGobiernoQueryHandler
{
    public function __construct(private readonly PlanGobiernoRepositoryInterface $repository) {}

    public function handle(GetAllPlanesGobiernoQuery $query): array
    {
        return $this->repository->all();
    }
}
