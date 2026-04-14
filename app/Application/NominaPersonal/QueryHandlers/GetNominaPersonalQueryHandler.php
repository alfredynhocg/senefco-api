<?php

namespace App\Application\NominaPersonal\QueryHandlers;

use App\Application\NominaPersonal\Queries\GetNominaPersonalQuery;
use App\Domain\NominaPersonal\Contracts\NominaPersonalRepositoryInterface;

class GetNominaPersonalQueryHandler
{
    public function __construct(private readonly NominaPersonalRepositoryInterface $repository) {}

    public function handle(GetNominaPersonalQuery $query): array
    {
        return $this->repository->paginate($query->pagination, $query->soloActivos);
    }
}
