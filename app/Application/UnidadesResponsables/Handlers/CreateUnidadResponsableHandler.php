<?php

namespace App\Application\UnidadesResponsables\Handlers;

use App\Application\UnidadesResponsables\Commands\CreateUnidadResponsableCommand;
use App\Application\UnidadesResponsables\DTOs\UnidadResponsableDTO;
use App\Domain\UnidadesResponsables\Contracts\UnidadResponsableRepositoryInterface;

class CreateUnidadResponsableHandler
{
    public function __construct(private readonly UnidadResponsableRepositoryInterface $repository) {}

    public function handle(CreateUnidadResponsableCommand $command): UnidadResponsableDTO
    {
        return $this->repository->create([
            'secretaria_id' => $command->secretaria_id,
            'nombre' => $command->nombre,
            'direccion' => $command->direccion,
            'telefono' => $command->telefono,
            'email' => $command->email,
            'horario' => $command->horario,
            'activa' => $command->activa,
        ]);
    }
}
