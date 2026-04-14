<?php

namespace App\Application\EjesPEI\Handlers;

use App\Application\EjesPEI\Commands\CreateEjePEICommand;
use App\Application\EjesPEI\DTOs\EjePEIDTO;
use App\Domain\EjesPEI\Contracts\EjePEIRepositoryInterface;

class CreateEjePEIHandler
{
    public function __construct(private readonly EjePEIRepositoryInterface $repository) {}

    public function handle(CreateEjePEICommand $command): EjePEIDTO
    {
        return $this->repository->create([
            'pei_id' => $command->pei_id,
            'numero_eje' => $command->numero_eje,
            'nombre' => $command->nombre,
            'descripcion' => $command->descripcion,
            'color_hex' => $command->color_hex,
            'total_objetivos' => $command->total_objetivos,
        ]);
    }
}
