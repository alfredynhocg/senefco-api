<?php

namespace App\Application\Permisos\Commands;

use App\Shared\Kernel\Contracts\CommandInterface;

final readonly class UpdatePermisoCommand implements CommandInterface
{
    public function __construct(
        public int $id,
        public array $data,
    ) {}
}
