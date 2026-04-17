<?php

namespace App\Application\Subcenefcos\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetSubcenefcosQuery
{
    public function __construct(
        public PaginationDTO $pagination,
        public bool $soloActivos = false,
    ) {}
}
