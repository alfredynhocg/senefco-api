<?php

namespace App\Application\IndicadoresGestion\Handlers;

use App\Application\IndicadoresGestion\Commands\CreateIndicadorCommand;
use App\Application\IndicadoresGestion\DTOs\IndicadorGestionDTO;
use App\Domain\IndicadoresGestion\Contracts\IndicadorGestionRepositoryInterface;

class CreateIndicadorHandler
{
    public function __construct(private readonly IndicadorGestionRepositoryInterface $repository) {}

    public function handle(CreateIndicadorCommand $command): IndicadorGestionDTO
    {
        return $this->repository->create([
            'categoria_id' => $command->categoria_id,
            'nombre' => $command->nombre,
            'descripcion' => $command->descripcion,
            'unidad_medida' => $command->unidad_medida,
            'frecuencia_actualizacion' => $command->frecuencia_actualizacion,
            'publico' => $command->publico,
            'activo' => $command->activo,
            'orden_dashboard' => $command->orden_dashboard,
        ]);
    }
}
