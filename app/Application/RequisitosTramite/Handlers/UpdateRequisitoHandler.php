<?php

namespace App\Application\RequisitosTramite\Handlers;

use App\Application\RequisitosTramite\Commands\UpdateRequisitoCommand;
use App\Application\RequisitosTramite\DTOs\RequisitoDTO;
use App\Domain\RequisitosTramite\Contracts\RequisitoRepositoryInterface;

class UpdateRequisitoHandler
{
    public function __construct(private readonly RequisitoRepositoryInterface $repository) {}

    public function handle(UpdateRequisitoCommand $command): RequisitoDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
