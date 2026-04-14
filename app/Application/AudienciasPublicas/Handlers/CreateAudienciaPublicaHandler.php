<?php

namespace App\Application\AudienciasPublicas\Handlers;

use App\Application\AudienciasPublicas\Commands\CreateAudienciaPublicaCommand;
use App\Application\AudienciasPublicas\DTOs\AudienciaPublicaDTO;
use App\Domain\AudienciasPublicas\Contracts\AudienciaPublicaRepositoryInterface;

class CreateAudienciaPublicaHandler
{
    public function __construct(
        private readonly AudienciaPublicaRepositoryInterface $repository
    ) {}

    public function handle(CreateAudienciaPublicaCommand $command): AudienciaPublicaDTO
    {
        return $this->repository->create([
            'titulo' => $command->titulo,
            'descripcion' => $command->descripcion,
            'tipo' => $command->tipo,
            'estado' => $command->estado,
            'acta_url' => $command->acta_url,
            'afiche_url' => $command->afiche_url,
            'imagenes' => $command->imagenes,
            'video_url' => $command->video_url,
            'enlace_virtual' => $command->enlace_virtual,
            'asistentes' => $command->asistentes,
        ]);
    }
}
