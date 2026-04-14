<?php

namespace App\Application\Proyectos\Handlers;

use App\Application\Proyectos\Commands\CreateProyectoCommand;
use App\Application\Proyectos\DTOs\ProyectoDTO;
use App\Domain\Proyectos\Contracts\ProyectoRepositoryInterface;

class CreateProyectoHandler
{
    public function __construct(private readonly ProyectoRepositoryInterface $repository) {}

    public function handle(CreateProyectoCommand $command): ProyectoDTO
    {
        return $this->repository->create([
            'codigo_sipfe' => $command->codigo_sipfe,
            'estado_id' => $command->estado_id,
            'secretaria_id' => $command->secretaria_id,
            'nombre' => $command->nombre,
            'descripcion' => $command->descripcion,
            'presupuesto_total' => $command->presupuesto_total,
            'ubicacion_texto' => $command->ubicacion_texto,
            'latitud' => $command->latitud,
            'longitud' => $command->longitud,
            'contratista' => $command->contratista,
            'fecha_inicio_estimada' => $command->fecha_inicio_estimada,
            'fecha_fin_estimada' => $command->fecha_fin_estimada,
            'imagen_portada_url' => $command->imagen_portada_url,
            'publico' => $command->publico,
        ]);
    }
}
