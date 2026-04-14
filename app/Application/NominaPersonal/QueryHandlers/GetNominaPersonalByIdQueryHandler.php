<?php

namespace App\Application\NominaPersonal\QueryHandlers;

use App\Application\NominaPersonal\DTOs\NominaPersonalDTO;
use App\Application\NominaPersonal\Queries\GetNominaPersonalByIdQuery;
use App\Domain\NominaPersonal\Contracts\NominaPersonalRepositoryInterface;

class GetNominaPersonalByIdQueryHandler
{
    public function __construct(private readonly NominaPersonalRepositoryInterface $repository) {}

    public function handle(GetNominaPersonalByIdQuery $query): NominaPersonalDTO
    {
        return $this->repository->findById($query->id);
    }
}
