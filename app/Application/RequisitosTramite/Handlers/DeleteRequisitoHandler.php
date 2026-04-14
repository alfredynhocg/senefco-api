<?php

namespace App\Application\RequisitosTramite\Handlers;

use App\Application\RequisitosTramite\Commands\DeleteRequisitoCommand;
use App\Domain\RequisitosTramite\Contracts\RequisitoRepositoryInterface;

class DeleteRequisitoHandler
{
    public function __construct(private readonly RequisitoRepositoryInterface $repository) {}

    public function handle(DeleteRequisitoCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
