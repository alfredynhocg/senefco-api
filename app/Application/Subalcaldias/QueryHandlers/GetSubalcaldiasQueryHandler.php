<?php

namespace App\Application\Subsenefcos\QueryHandlers;

use App\Application\Subsenefcos\Queries\GetSubsenefcosQuery;
use App\Domain\Subsenefcos\Contracts\SubsenefcoRepositoryInterface;

class GetSubsenefcosQueryHandler
{
    public function __construct(private readonly SubsenefcoRepositoryInterface $repository) {}

    public function handle(GetSubsenefcosQuery $query): array
    {
        return $this->repository->paginate($query->pagination, $query->soloActivos);
    }
}
