<?php

namespace App\Application\Eventos\Handlers;

use App\Application\Eventos\Commands\DeleteEventoCommand;
use App\Domain\Eventos\Contracts\EventoRepositoryInterface;

class DeleteEventoHandler
{
    public function __construct(private readonly EventoRepositoryInterface $repository) {}

    public function handle(DeleteEventoCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
