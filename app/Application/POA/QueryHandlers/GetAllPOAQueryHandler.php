<?php

namespace App\Application\POA\QueryHandlers;

use App\Application\POA\Queries\GetAllPOAQuery;
use App\Domain\POA\Contracts\POARepositoryInterface;

class GetAllPOAQueryHandler
{
    public function __construct(private readonly POARepositoryInterface $repository) {}

    public function handle(GetAllPOAQuery $query): array
    {
        return $this->repository->all();
    }
}
