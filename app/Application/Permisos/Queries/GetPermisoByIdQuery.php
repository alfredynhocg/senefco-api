<?php

namespace App\Application\Permisos\Queries;

use App\Shared\Kernel\Contracts\QueryInterface;

final readonly class GetPermisoByIdQuery implements QueryInterface
{
    public function __construct(public int $id) {}
}
