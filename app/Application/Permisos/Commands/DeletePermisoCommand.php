<?php

namespace App\Application\Permisos\Commands;

use App\Shared\Kernel\Contracts\CommandInterface;

final readonly class DeletePermisoCommand implements CommandInterface
{
    public function __construct(public int $id) {}
}
