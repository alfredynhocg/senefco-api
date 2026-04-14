<?php

namespace App\Application\TiposAuditoria\QueryHandlers;

use App\Application\TiposAuditoria\Queries\GetAllTiposAuditoriaQuery;
use App\Domain\TiposAuditoria\Contracts\TipoAuditoriaRepositoryInterface;

class GetAllTiposAuditoriaQueryHandler
{
    public function __construct(private readonly TipoAuditoriaRepositoryInterface $repository) {}

    public function handle(GetAllTiposAuditoriaQuery $query): array
    {
        return $this->repository->all();
    }
}
