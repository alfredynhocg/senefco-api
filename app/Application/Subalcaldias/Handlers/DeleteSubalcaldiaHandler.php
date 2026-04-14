<?php

namespace App\Application\Subsenefcos\Handlers;

use App\Application\Subsenefcos\Commands\DeleteSubsenefcoCommand;
use App\Domain\Subsenefcos\Contracts\SubsenefcoRepositoryInterface;

class DeleteSubsenefcoHandler
{
    public function __construct(private readonly SubsenefcoRepositoryInterface $repository) {}

    public function handle(DeleteSubsenefcoCommand $command): bool
    {
        return $this->repository->delete($command->id);
    }
}
