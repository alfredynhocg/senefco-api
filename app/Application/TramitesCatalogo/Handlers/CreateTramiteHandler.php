<?php

namespace App\Application\TramitesCatalogo\Handlers;

use App\Application\TramitesCatalogo\Commands\CreateTramiteCommand;
use App\Application\TramitesCatalogo\DTOs\TramiteDTO;
use App\Domain\TramitesCatalogo\Contracts\TramiteRepositoryInterface;

class CreateTramiteHandler
{
    public function __construct(private readonly TramiteRepositoryInterface $repository) {}

    public function handle(CreateTramiteCommand $command): TramiteDTO
    {
        return $this->repository->create([
            'tipo_tramite_id' => $command->tipo_tramite_id,
            'unidad_responsable_id' => $command->unidad_responsable_id,
            'creado_por' => $command->creado_por,
            'nombre' => $command->nombre,
            'descripcion' => $command->descripcion,
            'procedimiento' => $command->procedimiento,
            'costo' => $command->costo,
            'moneda' => $command->moneda,
            'dias_habiles_resolucion' => $command->dias_habiles_resolucion,
            'normativa_base' => $command->normativa_base,
            'url_formulario' => $command->url_formulario,
            'modalidad' => $command->modalidad,
            'activo' => $command->activo,
        ]);
    }
}
