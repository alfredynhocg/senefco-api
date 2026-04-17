<?php

namespace App\Application\Subcenefcos\QueryHandlers;

use App\Application\Subcenefcos\DTOs\SubcenefcoDTO;
use App\Application\Subcenefcos\Queries\GetSubcenefcoByIdQuery;
use App\Domain\Subcenefcos\Contracts\SubcenefcoRepositoryInterface;

class GetSubcenefcoByIdQueryHandler
{
    public function __construct(private readonly SubcenefcoRepositoryInterface $repository) {}

    public function handle(GetSubcenefcoByIdQuery $query): SubcenefcoDTO
    {
        return $this->repository->findById($query->id);
    }
}
