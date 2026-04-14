<?php

namespace App\Application\NominaPersonal\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetNominaPersonalQuery
{
    public function __construct(
        public PaginationDTO $pagination,
        public bool $soloActivos = false,
    ) {}
}
