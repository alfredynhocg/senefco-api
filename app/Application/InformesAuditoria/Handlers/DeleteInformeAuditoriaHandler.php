<?php

namespace App\Application\InformesAuditoria\Handlers;

use App\Application\InformesAuditoria\Commands\DeleteInformeAuditoriaCommand;
use App\Domain\InformesAuditoria\Contracts\InformeAuditoriaRepositoryInterface;

class DeleteInformeAuditoriaHandler
{
    public function __construct(
        private readonly InformeAuditoriaRepositoryInterface $repository
    ) {}

    public function handle(DeleteInformeAuditoriaCommand $command): void
    {
        $this->repository->delete($command->id);
    }
}
