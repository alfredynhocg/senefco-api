<?php

namespace App\Application\PlanesGobierno\QueryHandlers;

use App\Application\PlanesGobierno\DTOs\PlanGobiernoDTO;
use App\Application\PlanesGobierno\Queries\GetPlanGobiernoByIdQuery;
use App\Domain\PlanesGobierno\Contracts\PlanGobiernoRepositoryInterface;

class GetPlanGobiernoByIdQueryHandler
{
    public function __construct(private readonly PlanGobiernoRepositoryInterface $repository) {}

    public function handle(GetPlanGobiernoByIdQuery $query): PlanGobiernoDTO
    {
        return $this->repository->findById($query->id);
    }
}
