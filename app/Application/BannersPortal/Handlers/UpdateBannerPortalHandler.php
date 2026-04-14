<?php

namespace App\Application\BannersPortal\Handlers;

use App\Application\BannersPortal\Commands\UpdateBannerPortalCommand;
use App\Application\BannersPortal\DTOs\BannerPortalDTO;
use App\Domain\BannersPortal\Contracts\BannerPortalRepositoryInterface;

class UpdateBannerPortalHandler
{
    public function __construct(private readonly BannerPortalRepositoryInterface $repository) {}

    public function handle(UpdateBannerPortalCommand $command): BannerPortalDTO
    {
        return $this->repository->update($command->id, $command->data);
    }
}
