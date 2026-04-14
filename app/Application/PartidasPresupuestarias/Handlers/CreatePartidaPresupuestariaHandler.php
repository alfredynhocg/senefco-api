<?php

namespace App\Application\PartidasPresupuestarias\Handlers;

use App\Application\PartidasPresupuestarias\Commands\CreatePartidaPresupuestariaCommand;
use App\Application\PartidasPresupuestarias\DTOs\PartidaPresupuestariaDTO;
use App\Domain\PartidasPresupuestarias\Contracts\PartidaPresupuestariaRepositoryInterface;

class CreatePartidaPresupuestariaHandler
{
    public function __construct(private readonly PartidaPresupuestariaRepositoryInterface $repository) {}

    public function handle(CreatePartidaPresupuestariaCommand $command): PartidaPresupuestariaDTO
    {
        return $this->repository->create([
            'presupuesto_id' => $command->presupuesto_id,
            'codigo_partida' => $command->codigo_partida,
            'descripcion' => $command->descripcion,
            'monto_asignado' => $command->monto_asignado,
            'categoria' => $command->categoria,
        ]);
    }
}
