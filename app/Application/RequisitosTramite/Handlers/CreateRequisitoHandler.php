<?php

namespace App\Application\RequisitosTramite\Handlers;

use App\Application\RequisitosTramite\Commands\CreateRequisitoCommand;
use App\Application\RequisitosTramite\DTOs\RequisitoDTO;
use App\Domain\RequisitosTramite\Contracts\RequisitoRepositoryInterface;

class CreateRequisitoHandler
{
    public function __construct(private readonly RequisitoRepositoryInterface $repository) {}

    public function handle(CreateRequisitoCommand $command): RequisitoDTO
    {
        return $this->repository->create([
            'tramite_id' => $command->tramite_id,
            'nombre' => $command->nombre,
            'descripcion' => $command->descripcion,
            'obligatorio' => $command->obligatorio,
            'tipo' => $command->tipo,
            'orden' => $command->orden,
        ]);
    }
}
