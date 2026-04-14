<?php

namespace App\Application\BannersPortal\Handlers;

use App\Application\BannersPortal\Commands\CreateBannerPortalCommand;
use App\Application\BannersPortal\DTOs\BannerPortalDTO;
use App\Domain\BannersPortal\Contracts\BannerPortalRepositoryInterface;

class CreateBannerPortalHandler
{
    public function __construct(private readonly BannerPortalRepositoryInterface $repository) {}

    public function handle(CreateBannerPortalCommand $command): BannerPortalDTO
    {
        return $this->repository->create([
            'titulo' => $command->titulo,
            'descripcion' => $command->descripcion,
            'imagen_url' => $command->imagen_url,
            'enlace_url' => $command->enlace_url,
            'fecha_inicio' => $command->fecha_inicio,
            'fecha_fin' => $command->fecha_fin,
            'activo' => $command->activo,
            'orden' => $command->orden,
        ]);
    }
}
