<?php

namespace App\Application\RedesSociales\Commands;

use App\Shared\Kernel\Contracts\CommandInterface;

final readonly class UpdateRedSocialCommand implements CommandInterface
{
    public function __construct(
        public int $id,
        public array $data,
    ) {}
}
