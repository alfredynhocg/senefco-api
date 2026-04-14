<?php

namespace App\Application\HallazgosAuditoria\Handlers;

use App\Application\HallazgosAuditoria\Commands\CreateHallazgoAuditoriaCommand;
use App\Application\HallazgosAuditoria\DTOs\HallazgoAuditoriaDTO;
use App\Domain\HallazgosAuditoria\Contracts\HallazgoAuditoriaRepositoryInterface;

class CreateHallazgoAuditoriaHandler
{
    public function __construct(private readonly HallazgoAuditoriaRepositoryInterface $repository) {}

    public function handle(CreateHallazgoAuditoriaCommand $command): HallazgoAuditoriaDTO
    {
        return $this->repository->create([
            'auditoria_id' => $command->auditoria_id,
            'tipo' => $command->tipo,
            'descripcion' => $command->descripcion,
            'recomendacion' => $command->recomendacion,
            'estado_seguimiento' => $command->estado_seguimiento,
            'secretaria_responsable_id' => $command->secretaria_responsable_id,
            'fecha_limite' => $command->fecha_limite,
        ]);
    }
}
