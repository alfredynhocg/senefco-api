<?php

namespace App\Application\Auditorias\QueryHandlers;

use App\Application\Auditorias\Queries\GetPaginatedAuditoriasQuery;
use App\Domain\Auditorias\Contracts\AuditoriaRepositoryInterface;

class GetPaginatedAuditoriasQueryHandler
{
    public function __construct(private readonly AuditoriaRepositoryInterface $repository) {}

    public function handle(GetPaginatedAuditoriasQuery $query): array
    {
        return $this->repository->paginate($query->pagination, $query->filters);
    }
}
