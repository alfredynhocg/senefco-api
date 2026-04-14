<?php

namespace App\Application\TiposTramite\Handlers;

use App\Application\TiposTramite\Commands\CreateTipoTramiteCommand;
use App\Application\TiposTramite\DTOs\TipoTramiteDTO;
use App\Domain\TiposTramite\Contracts\TipoTramiteRepositoryInterface;

class CreateTipoTramiteHandler
{
    public function __construct(private readonly TipoTramiteRepositoryInterface $repository) {}

    public function handle(CreateTipoTramiteCommand $command): TipoTramiteDTO
    {
        return $this->repository->create([
            'nombre' => $command->nombre,
            'icono_url' => $command->icono_url,
            'color_hex' => $command->color_hex,
            'activo' => $command->activo,
            'orden' => $command->orden,
        ]);
    }
}
