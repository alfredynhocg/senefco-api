<?php

namespace App\Application\Presupuestos\Handlers;

use App\Application\Presupuestos\Commands\CreatePresupuestoCommand;
use App\Application\Presupuestos\DTOs\PresupuestoDTO;
use App\Domain\Presupuestos\Contracts\PresupuestoRepositoryInterface;

class CreatePresupuestoHandler
{
    public function __construct(private readonly PresupuestoRepositoryInterface $repository) {}

    public function handle(CreatePresupuestoCommand $command): PresupuestoDTO
    {
        return $this->repository->create([
            'secretaria_id' => $command->secretaria_id,
            'gestion' => $command->gestion,
            'monto_aprobado' => $command->monto_aprobado,
            'monto_modificado' => $command->monto_modificado,
            'estado' => $command->estado,
            'documento_url' => $command->documento_url,
            'fecha_aprobacion' => $command->fecha_aprobacion,
            'aprobado_por' => $command->aprobado_por,
        ]);
    }
}
