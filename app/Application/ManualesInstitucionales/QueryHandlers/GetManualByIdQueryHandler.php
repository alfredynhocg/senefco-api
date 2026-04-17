<?php

namespace App\Application\ManualesInstitucionales\QueryHandlers;

use App\Application\ManualesInstitucionales\DTOs\ManualInstitucionalDTO;
use App\Application\ManualesInstitucionales\Queries\GetManualByIdQuery;
use App\Domain\ManualesInstitucionales\Contracts\ManualInstitucionalRepositoryInterface;

class GetManualByIdQueryHandler
{
    public function __construct(private readonly ManualInstitucionalRepositoryInterface $repository) {}

    public function handle(GetManualByIdQuery $query): ManualInstitucionalDTO
    {
        return $this->repository->findById($query->id);
    }
}
