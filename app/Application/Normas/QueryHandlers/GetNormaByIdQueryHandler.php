<?php

namespace App\Application\Normas\QueryHandlers;

use App\Application\Normas\DTOs\NormaDTO;
use App\Application\Normas\Queries\GetNormaByIdQuery;
use App\Domain\Normas\Contracts\NormaRepositoryInterface;

class GetNormaByIdQueryHandler
{
    public function __construct(private readonly NormaRepositoryInterface $repository) {}

    public function handle(GetNormaByIdQuery $query): NormaDTO
    {
        return $this->repository->findById($query->id);
    }
}
