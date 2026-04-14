<?php

namespace App\Application\PortalIndicadores\QueryHandlers;

use App\Application\PortalIndicadores\Queries\GetPortalIndicadorByIdQuery;
use App\Domain\PortalIndicadores\Contracts\PortalIndicadorRepositoryInterface;

class GetPortalIndicadorByIdQueryHandler
{
    public function __construct(private readonly PortalIndicadorRepositoryInterface $repository) {}

    public function handle(GetPortalIndicadorByIdQuery $query): mixed
    {
        return $this->repository->findById($query->id);
    }
}
