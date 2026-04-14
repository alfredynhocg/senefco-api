<?php

namespace App\Application\InformesAuditoria\QueryHandlers;

use App\Application\InformesAuditoria\Queries\GetInformesAuditoriaQuery;
use App\Domain\InformesAuditoria\Contracts\InformeAuditoriaRepositoryInterface;

class GetInformesAuditoriaQueryHandler
{
    public function __construct(
        private readonly InformeAuditoriaRepositoryInterface $repository
    ) {}

    public function handle(GetInformesAuditoriaQuery $query): array
    {
        return $this->repository->paginate($query->pagination, $query->soloPublicados);
    }
}
