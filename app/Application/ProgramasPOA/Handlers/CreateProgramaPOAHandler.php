<?php

namespace App\Application\ProgramasPOA\Handlers;

use App\Application\ProgramasPOA\Commands\CreateProgramaPOACommand;
use App\Application\ProgramasPOA\DTOs\ProgramaPOADTO;
use App\Domain\ProgramasPOA\Contracts\ProgramaPOARepositoryInterface;

class CreateProgramaPOAHandler
{
    public function __construct(private readonly ProgramaPOARepositoryInterface $repository) {}

    public function handle(CreateProgramaPOACommand $command): ProgramaPOADTO
    {
        return $this->repository->create([
            'poa_id' => $command->poa_id,
            'nombre' => $command->nombre,
            'descripcion' => $command->descripcion,
            'presupuesto_asignado' => $command->presupuesto_asignado,
            'meta_indicador' => $command->meta_indicador,
            'unidad_medida' => $command->unidad_medida,
            'estado' => $command->estado,
        ]);
    }
}
