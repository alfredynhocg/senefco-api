<?php

namespace App\Application\Items\Handlers;

use App\Application\Items\Commands\UpdateItemCommand;
use App\Application\Items\DTOs\ItemDTO;
use App\Domain\Items\Contracts\ItemRepositoryInterface;

class UpdateItemHandler
{
    public function __construct(private readonly ItemRepositoryInterface $repository) {}

    public function handle(UpdateItemCommand $command): ItemDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
