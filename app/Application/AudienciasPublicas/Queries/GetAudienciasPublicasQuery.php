<?php

namespace App\Application\AudienciasPublicas\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetAudienciasPublicasQuery
{
    public function __construct(
        public PaginationDTO $pagination,
        public bool $soloActivos = false,
    ) {}
}
