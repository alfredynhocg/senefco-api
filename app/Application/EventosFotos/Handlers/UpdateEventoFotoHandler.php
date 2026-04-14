<?php

namespace App\Application\EventosFotos\Handlers;

use App\Application\EventosFotos\Commands\UpdateEventoFotoCommand;
use App\Application\EventosFotos\DTOs\EventoFotoDTO;
use App\Domain\EventosFotos\Contracts\EventoFotoRepositoryInterface;

class UpdateEventoFotoHandler
{
    public function __construct(private readonly EventoFotoRepositoryInterface $repository) {}

    public function handle(UpdateEventoFotoCommand $command): EventoFotoDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
