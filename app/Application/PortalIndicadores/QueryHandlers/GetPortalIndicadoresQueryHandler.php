<?php

namespace App\Application\PortalIndicadores\QueryHandlers;

use App\Application\PortalIndicadores\Queries\GetPortalIndicadoresQuery;
use App\Domain\PortalIndicadores\Contracts\PortalIndicadorRepositoryInterface;

class GetPortalIndicadoresQueryHandler
{
    public function __construct(private readonly PortalIndicadorRepositoryInterface $repository) {}

    public function handle(GetPortalIndicadoresQuery $query): array
    {
        return $this->repository->paginate($query->pagination, $query->categoria, $query->estado);
    }
}
