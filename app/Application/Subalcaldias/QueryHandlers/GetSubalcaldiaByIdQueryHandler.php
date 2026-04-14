<?php

namespace App\Application\Subsenefcos\QueryHandlers;

use App\Application\Subsenefcos\DTOs\SubsenefcoDTO;
use App\Application\Subsenefcos\Queries\GetSubsenefcoByIdQuery;
use App\Domain\Subsenefcos\Contracts\SubsenefcoRepositoryInterface;

class GetSubsenefcoByIdQueryHandler
{
    public function __construct(private readonly SubsenefcoRepositoryInterface $repository) {}

    public function handle(GetSubsenefcoByIdQuery $query): SubsenefcoDTO
    {
        return $this->repository->findById($query->id);
    }
}
