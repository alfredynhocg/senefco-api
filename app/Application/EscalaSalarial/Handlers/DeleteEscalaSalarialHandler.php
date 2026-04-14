<?php

namespace App\Application\EscalaSalarial\Handlers;

use App\Application\EscalaSalarial\Commands\DeleteEscalaSalarialCommand;
use App\Domain\EscalaSalarial\Contracts\EscalaSalarialRepositoryInterface;

class DeleteEscalaSalarialHandler
{
    public function __construct(private readonly EscalaSalarialRepositoryInterface $repository) {}

    public function handle(DeleteEscalaSalarialCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
