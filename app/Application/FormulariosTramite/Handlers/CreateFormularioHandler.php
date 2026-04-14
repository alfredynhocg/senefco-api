<?php

namespace App\Application\FormulariosTramite\Handlers;

use App\Application\FormulariosTramite\Commands\CreateFormularioCommand;
use App\Application\FormulariosTramite\DTOs\FormularioDTO;
use App\Domain\FormulariosTramite\Contracts\FormularioRepositoryInterface;

class CreateFormularioHandler
{
    public function __construct(private readonly FormularioRepositoryInterface $repository) {}

    public function handle(CreateFormularioCommand $command): FormularioDTO
    {
        return $this->repository->create([
            'tramite_id' => $command->tramite_id,
            'nombre' => $command->nombre,
            'archivo_url' => $command->archivo_url,
            'formato' => $command->formato,
            'fecha_actualizacion' => $command->fecha_actualizacion,
            'activo' => $command->activo,
        ]);
    }
}
