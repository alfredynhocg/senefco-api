<?php

namespace App\Application\Subsenefcos\Handlers;

use App\Application\Subsenefcos\Commands\UpdateSubsenefcoCommand;
use App\Application\Subsenefcos\DTOs\SubsenefcoDTO;
use App\Domain\Subsenefcos\Contracts\SubsenefcoRepositoryInterface;

class UpdateSubsenefcoHandler
{
    public function __construct(private readonly SubsenefcoRepositoryInterface $repository) {}

    public function handle(UpdateSubsenefcoCommand $command): SubsenefcoDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
