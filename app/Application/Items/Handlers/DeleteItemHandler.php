<?php

namespace App\Application\Items\Handlers;

use App\Application\Items\Commands\DeleteItemCommand;
use App\Domain\Items\Contracts\ItemRepositoryInterface;

class DeleteItemHandler
{
    public function __construct(private readonly ItemRepositoryInterface $repository) {}

    public function handle(DeleteItemCommand $command): void
    {
        $this->repository->delete($command->id);
    }
}
