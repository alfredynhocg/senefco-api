<?php

namespace App\Application\HallazgosAuditoria\QueryHandlers;

use App\Application\HallazgosAuditoria\Queries\GetHallazgosByAuditoriaQuery;
use App\Domain\HallazgosAuditoria\Contracts\HallazgoAuditoriaRepositoryInterface;

class GetHallazgosByAuditoriaQueryHandler
{
    public function __construct(private readonly HallazgoAuditoriaRepositoryInterface $repository) {}

    public function handle(GetHallazgosByAuditoriaQuery $query): array
    {
        return $this->repository->findByAuditoria($query->auditoriaId);
    }
}
