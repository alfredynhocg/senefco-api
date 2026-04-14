<?php

namespace App\Application\Auditorias\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetPaginatedAuditoriasQuery
{
    public function __construct(
        public PaginationDTO $pagination,
        public array $filters = [],
    ) {}
}
