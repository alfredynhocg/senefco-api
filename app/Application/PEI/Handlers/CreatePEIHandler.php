<?php

namespace App\Application\PEI\Handlers;

use App\Application\PEI\Commands\CreatePEICommand;
use App\Application\PEI\DTOs\PEIDTO;
use App\Domain\PEI\Contracts\PEIRepositoryInterface;

class CreatePEIHandler
{
    public function __construct(private readonly PEIRepositoryInterface $repository) {}

    public function handle(CreatePEICommand $command): PEIDTO
    {
        return $this->repository->create([
            'titulo' => $command->titulo,
            'anio_inicio' => $command->anio_inicio,
            'anio_fin' => $command->anio_fin,
            'descripcion' => $command->descripcion,
            'documento_pdf_url' => $command->documento_pdf_url,
            'estado' => $command->estado,
            'aprobado_por' => $command->aprobado_por,
            'fecha_aprobacion' => $command->fecha_aprobacion,
            'vigente' => $command->vigente,
        ]);
    }
}
