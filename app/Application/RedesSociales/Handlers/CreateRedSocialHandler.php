<?php

namespace App\Application\RedesSociales\Handlers;

use App\Application\RedesSociales\Commands\CreateRedSocialCommand;
use App\Application\RedesSociales\DTOs\RedSocialDTO;
use App\Domain\RedesSociales\Contracts\RedSocialRepositoryInterface;
use App\Domain\RedesSociales\Events\RedSocialCreated;
use App\Shared\Kernel\Contracts\CommandHandlerInterface;
use App\Shared\Kernel\Contracts\CommandInterface;
use Illuminate\Contracts\Events\Dispatcher;

class CreateRedSocialHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly RedSocialRepositoryInterface $repository,
        private readonly Dispatcher $events,
    ) {}

    public function handle(CommandInterface $command): RedSocialDTO
    {
        /** @var CreateRedSocialCommand $command */
        $redSocial = $this->repository->create([
            'plataforma' => $command->plataforma,
            'url' => $command->url,
            'nombre_cuenta' => $command->nombre_cuenta,
            'icono_clase' => $command->icono_clase,
            'activo' => $command->activo,
            'orden' => $command->orden,
        ]);

        $this->events->dispatch(new RedSocialCreated($redSocial->id));

        return RedSocialDTO::fromModel($redSocial);
    }
}
