<?php

namespace App\Application\InformesAuditoria\Handlers;

use App\Application\InformesAuditoria\Commands\UpdateInformeAuditoriaCommand;
use App\Application\InformesAuditoria\DTOs\InformeAuditoriaDTO;
use App\Domain\InformesAuditoria\Contracts\InformeAuditoriaRepositoryInterface;

class UpdateInformeAuditoriaHandler
{
    public function __construct(
        private readonly InformeAuditoriaRepositoryInterface $repository
    ) {}

    public function handle(UpdateInformeAuditoriaCommand $command): InformeAuditoriaDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
