<?php

namespace App\Application\Items\QueryHandlers;

use App\Application\Items\Queries\GetItemByIdQuery;
use App\Domain\Items\Contracts\ItemRepositoryInterface;

class GetItemByIdQueryHandler
{
    public function __construct(private readonly ItemRepositoryInterface $repository) {}

    public function handle(GetItemByIdQuery $query): mixed
    {
        return $this->repository->findById($query->id);
    }
}
