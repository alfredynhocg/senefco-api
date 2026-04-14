<?php

namespace App\Application\Permisos\Commands;

use App\Shared\Kernel\Contracts\CommandInterface;

final readonly class CreatePermisoCommand implements CommandInterface
{
    public function __construct(
        public string $codigo,
        public ?string $descripcion = null,
        public ?string $modulo = null,
    ) {}
}
