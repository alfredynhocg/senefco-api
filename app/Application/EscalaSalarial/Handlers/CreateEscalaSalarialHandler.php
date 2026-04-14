<?php

namespace App\Application\EscalaSalarial\Handlers;

use App\Application\EscalaSalarial\Commands\CreateEscalaSalarialCommand;
use App\Application\EscalaSalarial\DTOs\EscalaSalarialDTO;
use App\Domain\EscalaSalarial\Contracts\EscalaSalarialRepositoryInterface;

class CreateEscalaSalarialHandler
{
    public function __construct(private readonly EscalaSalarialRepositoryInterface $repository) {}

    public function handle(CreateEscalaSalarialCommand $command): EscalaSalarialDTO
    {
        return $this->repository->create([
            'nivel' => $command->nivel,
            'descripcion_cargo' => $command->descripcion_cargo,
            'sueldo_basico' => $command->sueldo_basico,
            'categoria' => $command->categoria,
        ]);
    }
}
