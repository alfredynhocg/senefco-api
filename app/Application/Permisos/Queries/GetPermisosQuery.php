<?php

namespace App\Application\Permisos\Queries;

use App\Shared\Kernel\Contracts\QueryInterface;
use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetPermisosQuery implements QueryInterface
{
    public function __construct(public PaginationDTO $pagination) {}
}
