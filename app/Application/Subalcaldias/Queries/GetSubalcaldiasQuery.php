<?php

namespace App\Application\Subsenefcos\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetSubsenefcosQuery
{
    public function __construct(
        public PaginationDTO $pagination,
        public bool $soloActivos = false,
    ) {}
}
