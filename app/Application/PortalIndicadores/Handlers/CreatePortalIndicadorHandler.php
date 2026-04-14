<?php

namespace App\Application\PortalIndicadores\Handlers;

use App\Application\PortalIndicadores\Commands\CreatePortalIndicadorCommand;
use App\Application\PortalIndicadores\DTOs\PortalIndicadorDTO;
use App\Domain\PortalIndicadores\Contracts\PortalIndicadorRepositoryInterface;

class CreatePortalIndicadorHandler
{
    public function __construct(private readonly PortalIndicadorRepositoryInterface $repository) {}

    public function handle(CreatePortalIndicadorCommand $command): PortalIndicadorDTO
    {
        return $this->repository->create([
            'nombre' => $command->nombre,
            'descripcion' => $command->descripcion,
            'categoria' => $command->categoria,
            'unidad' => $command->unidad,
            'meta' => $command->meta,
            'valor_actual' => $command->valor_actual,
            'periodo' => $command->periodo,
            'fecha_medicion' => $command->fecha_medicion,
            'estado' => $command->estado,
            'responsable' => $command->responsable,
            'publicado' => $command->publicado,
            'activo' => $command->activo,
        ]);
    }
}
