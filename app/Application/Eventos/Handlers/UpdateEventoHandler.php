<?php

namespace App\Application\Eventos\Handlers;

use App\Application\Eventos\Commands\UpdateEventoCommand;
use App\Application\Eventos\DTOs\EventoDTO;
use App\Domain\Eventos\Contracts\EventoRepositoryInterface;

class UpdateEventoHandler
{
    public function __construct(private readonly EventoRepositoryInterface $repository) {}

    public function handle(UpdateEventoCommand $command): EventoDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
