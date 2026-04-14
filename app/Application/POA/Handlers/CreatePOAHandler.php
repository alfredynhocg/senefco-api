<?php

namespace App\Application\POA\Handlers;

use App\Application\POA\Commands\CreatePOACommand;
use App\Application\POA\DTOs\POADTO;
use App\Domain\POA\Contracts\POARepositoryInterface;

class CreatePOAHandler
{
    public function __construct(private readonly POARepositoryInterface $repository) {}

    public function handle(CreatePOACommand $command): POADTO
    {
        return $this->repository->create([
            'plan_gobierno_id' => $command->plan_gobierno_id,
            'secretaria_id' => $command->secretaria_id,
            'gestion' => $command->gestion,
            'titulo' => $command->titulo,
            'documento_pdf_url' => $command->documento_pdf_url,
            'resumen_ejecutivo_url' => $command->resumen_ejecutivo_url,
            'estado' => $command->estado,
            'aprobado_por' => $command->aprobado_por,
            'fecha_aprobacion' => $command->fecha_aprobacion,
        ]);
    }
}
