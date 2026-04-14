<?php

namespace App\Application\InformesAuditoria\QueryHandlers;

use App\Application\InformesAuditoria\DTOs\InformeAuditoriaDTO;
use App\Application\InformesAuditoria\Queries\GetInformeAuditoriaByIdQuery;
use App\Domain\InformesAuditoria\Contracts\InformeAuditoriaRepositoryInterface;

class GetInformeAuditoriaByIdQueryHandler
{
    public function __construct(
        private readonly InformeAuditoriaRepositoryInterface $repository
    ) {}

    public function handle(GetInformeAuditoriaByIdQuery $query): InformeAuditoriaDTO
    {
        return $this->repository->findById($query->id);
    }
}
