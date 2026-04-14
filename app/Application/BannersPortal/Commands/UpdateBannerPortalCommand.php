<?php

namespace App\Application\BannersPortal\Commands;

final readonly class UpdateBannerPortalCommand
{
    public function __construct(public int $id, public array $data) {}
}
