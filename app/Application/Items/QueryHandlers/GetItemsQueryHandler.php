<?php

namespace App\Application\Items\QueryHandlers;

use App\Application\Items\Queries\GetItemsQuery;
use App\Domain\Items\Contracts\ItemRepositoryInterface;

class GetItemsQueryHandler
{
    public function __construct(private readonly ItemRepositoryInterface $repository) {}

    public function handle(GetItemsQuery $query): array
    {
        return $this->repository->paginate($query->pagination, $query->tipo);
    }
}
