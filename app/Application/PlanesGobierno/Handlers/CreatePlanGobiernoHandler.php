<?php

namespace App\Application\PlanesGobierno\Handlers;

use App\Application\PlanesGobierno\Commands\CreatePlanGobiernoCommand;
use App\Application\PlanesGobierno\DTOs\PlanGobiernoDTO;
use App\Domain\PlanesGobierno\Contracts\PlanGobiernoRepositoryInterface;

class CreatePlanGobiernoHandler
{
    public function __construct(private readonly PlanGobiernoRepositoryInterface $repository) {}

    public function handle(CreatePlanGobiernoCommand $command): PlanGobiernoDTO
    {
        return $this->repository->create([
            'titulo' => $command->titulo,
            'gestion_inicio' => $command->gestion_inicio,
            'gestion_fin' => $command->gestion_fin,
            'descripcion' => $command->descripcion,
            'documento_pdf_url' => $command->documento_pdf_url,
            'publicado_por' => $command->publicado_por,
            'vigente' => $command->vigente,
        ]);
    }
}
