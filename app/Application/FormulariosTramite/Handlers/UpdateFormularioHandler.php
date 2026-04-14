<?php

namespace App\Application\FormulariosTramite\Handlers;

use App\Application\FormulariosTramite\Commands\UpdateFormularioCommand;
use App\Application\FormulariosTramite\DTOs\FormularioDTO;
use App\Domain\FormulariosTramite\Contracts\FormularioRepositoryInterface;

class UpdateFormularioHandler
{
    public function __construct(private readonly FormularioRepositoryInterface $repository) {}

    public function handle(UpdateFormularioCommand $command): FormularioDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
