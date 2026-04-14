<?php

namespace App\Application\AvanceProyecto\Handlers;

use App\Application\AvanceProyecto\Commands\CreateAvanceProyectoCommand;
use App\Application\AvanceProyecto\DTOs\AvanceProyectoDTO;
use App\Domain\AvanceProyecto\Contracts\AvanceProyectoRepositoryInterface;

class CreateAvanceProyectoHandler
{
    public function __construct(private readonly AvanceProyectoRepositoryInterface $repository) {}

    public function handle(CreateAvanceProyectoCommand $command): AvanceProyectoDTO
    {
        return $this->repository->create([
            'proyecto_id' => $command->proyecto_id,
            'porcentaje_fisico' => $command->porcentaje_fisico,
            'monto_financiero_ejecutado' => $command->monto_financiero_ejecutado,
            'descripcion_avance' => $command->descripcion_avance,
            'fecha_reporte' => $command->fecha_reporte,
            'fotografia_url' => $command->fotografia_url,
            'registrado_por' => $command->registrado_por,
        ]);
    }
}
