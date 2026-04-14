<?php

namespace App\Application\EscalaSalarial\Handlers;

use App\Application\EscalaSalarial\Commands\UpdateEscalaSalarialCommand;
use App\Application\EscalaSalarial\DTOs\EscalaSalarialDTO;
use App\Domain\EscalaSalarial\Contracts\EscalaSalarialRepositoryInterface;

class UpdateEscalaSalarialHandler
{
    public function __construct(private readonly EscalaSalarialRepositoryInterface $repository) {}

    public function handle(UpdateEscalaSalarialCommand $command): EscalaSalarialDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
