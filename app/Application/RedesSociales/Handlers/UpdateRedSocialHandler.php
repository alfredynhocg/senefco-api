<?php

namespace App\Application\RedesSociales\Handlers;

use App\Application\RedesSociales\Commands\UpdateRedSocialCommand;
use App\Application\RedesSociales\DTOs\RedSocialDTO;
use App\Domain\RedesSociales\Contracts\RedSocialRepositoryInterface;
use App\Shared\Kernel\Contracts\CommandHandlerInterface;
use App\Shared\Kernel\Contracts\CommandInterface;

class UpdateRedSocialHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly RedSocialRepositoryInterface $repository,
    ) {}

    public function handle(CommandInterface $command): RedSocialDTO
    {
        /** @var UpdateRedSocialCommand $command */
        return $this->repository->update($command->id, $command->data);
    }
}
