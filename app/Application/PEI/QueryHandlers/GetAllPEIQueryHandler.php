<?php

namespace App\Application\PEI\QueryHandlers;

use App\Application\PEI\Queries\GetAllPEIQuery;
use App\Domain\PEI\Contracts\PEIRepositoryInterface;

class GetAllPEIQueryHandler
{
    public function __construct(private readonly PEIRepositoryInterface $repository) {}

    public function handle(GetAllPEIQuery $query): array
    {
        return $this->repository->all();
    }
}
