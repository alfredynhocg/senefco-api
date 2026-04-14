<?php

namespace App\Application\FormulariosTramite\Handlers;

use App\Application\FormulariosTramite\Commands\DeleteFormularioCommand;
use App\Domain\FormulariosTramite\Contracts\FormularioRepositoryInterface;

class DeleteFormularioHandler
{
    public function __construct(private readonly FormularioRepositoryInterface $repository) {}

    public function handle(DeleteFormularioCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
