<?php

namespace App\Application\Autoridades\Handlers;

use App\Application\Autoridades\Commands\UpdateAutoridadCommand;
use App\Application\Autoridades\DTOs\AutoridadDTO;
use App\Domain\Autoridades\Contracts\AutoridadRepositoryInterface;

class UpdateAutoridadHandler
{
    public function __construct(private readonly AutoridadRepositoryInterface $repository) {}

    public function handle(UpdateAutoridadCommand $command): AutoridadDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
