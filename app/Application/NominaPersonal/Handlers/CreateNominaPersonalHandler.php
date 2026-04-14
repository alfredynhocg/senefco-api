<?php

namespace App\Application\NominaPersonal\Handlers;

use App\Application\NominaPersonal\Commands\CreateNominaPersonalCommand;
use App\Application\NominaPersonal\DTOs\NominaPersonalDTO;
use App\Domain\NominaPersonal\Contracts\NominaPersonalRepositoryInterface;

class CreateNominaPersonalHandler
{
    public function __construct(private readonly NominaPersonalRepositoryInterface $repository) {}

    public function handle(CreateNominaPersonalCommand $command): NominaPersonalDTO
    {
        return $this->repository->create([
            'usuario_id' => $command->usuario_id,
            'secretaria_id' => $command->secretaria_id,
            'nombre' => $command->nombre,
            'apellido' => $command->apellido,
            'ci' => $command->ci,
            'cargo' => $command->cargo,
            'nivel_salarial' => $command->nivel_salarial,
            'tipo_contrato' => $command->tipo_contrato,
            'gestion' => $command->gestion,
            'activo' => $command->activo,
        ]);
    }
}
