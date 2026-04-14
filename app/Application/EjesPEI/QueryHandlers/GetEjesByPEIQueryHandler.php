<?php

namespace App\Application\EjesPEI\QueryHandlers;

use App\Application\EjesPEI\Queries\GetEjesByPEIQuery;
use App\Domain\EjesPEI\Contracts\EjePEIRepositoryInterface;

class GetEjesByPEIQueryHandler
{
    public function __construct(private readonly EjePEIRepositoryInterface $repository) {}

    public function handle(GetEjesByPEIQuery $query): array
    {
        return $this->repository->findByPei($query->peiId);
    }
}
