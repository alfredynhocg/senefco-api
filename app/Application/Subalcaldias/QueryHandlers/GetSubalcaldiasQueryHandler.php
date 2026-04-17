<?php

namespace App\Application\Subcenefcos\QueryHandlers;

use App\Application\Subcenefcos\Queries\GetSubcenefcosQuery;
use App\Domain\Subcenefcos\Contracts\SubcenefcoRepositoryInterface;

class GetSubcenefcosQueryHandler
{
    public function __construct(private readonly SubcenefcoRepositoryInterface $repository) {}

    public function handle(GetSubcenefcosQuery $query): array
    {
        return $this->repository->paginate($query->pagination, $query->soloActivos);
    }
}
