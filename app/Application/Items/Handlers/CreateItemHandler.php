<?php

namespace App\Application\Items\Handlers;

use App\Application\Items\Commands\CreateItemCommand;
use App\Application\Items\DTOs\ItemDTO;
use App\Domain\Items\Contracts\ItemRepositoryInterface;

class CreateItemHandler
{
    public function __construct(private readonly ItemRepositoryInterface $repository) {}

    public function handle(CreateItemCommand $command): ItemDTO
    {
        return $this->repository->create([
            'nombre' => $command->nombre,
            'descripcion' => $command->descripcion,
            'tipo' => $command->tipo,
            'precio' => $command->precio,
            'imagen_url' => $command->imagen_url,
            'enlace_url' => $command->enlace_url,
            'orden' => $command->orden,
            'publicado' => $command->publicado,
            'activo' => $command->activo,
        ]);
    }
}
