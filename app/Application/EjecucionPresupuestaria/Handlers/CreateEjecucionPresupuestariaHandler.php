<?php

namespace App\Application\EjecucionPresupuestaria\Handlers;

use App\Application\EjecucionPresupuestaria\Commands\CreateEjecucionPresupuestariaCommand;
use App\Application\EjecucionPresupuestaria\DTOs\EjecucionPresupuestariaDTO;
use App\Domain\EjecucionPresupuestaria\Contracts\EjecucionPresupuestariaRepositoryInterface;

class CreateEjecucionPresupuestariaHandler
{
    public function __construct(private readonly EjecucionPresupuestariaRepositoryInterface $repository) {}

    public function handle(CreateEjecucionPresupuestariaCommand $command): EjecucionPresupuestariaDTO
    {
        return $this->repository->create([
            'partida_id' => $command->partida_id,
            'proyecto_id' => $command->proyecto_id,
            'monto_devengado' => $command->monto_devengado,
            'monto_pagado' => $command->monto_pagado,
            'mes' => $command->mes,
            'gestion' => $command->gestion,
            'descripcion_gasto' => $command->descripcion_gasto,
            'fecha_registro' => $command->fecha_registro,
            'registrado_por' => $command->registrado_por,
        ]);
    }
}
