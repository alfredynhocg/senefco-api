<?php

namespace App\Application\ValoresIndicador\Handlers;

use App\Application\ValoresIndicador\Commands\CreateValorIndicadorCommand;
use App\Application\ValoresIndicador\DTOs\ValorIndicadorDTO;
use App\Domain\ValoresIndicador\Contracts\ValorIndicadorRepositoryInterface;

class CreateValorIndicadorHandler
{
    public function __construct(private readonly ValorIndicadorRepositoryInterface $repository) {}

    public function handle(CreateValorIndicadorCommand $command): ValorIndicadorDTO
    {
        return $this->repository->create([
            'indicador_id' => $command->indicador_id,
            'valor' => $command->valor,
            'gestion' => $command->gestion,
            'mes' => $command->mes,
            'fecha_registro' => $command->fecha_registro,
            'fuente' => $command->fuente,
            'registrado_por' => $command->registrado_por,
        ]);
    }
}
