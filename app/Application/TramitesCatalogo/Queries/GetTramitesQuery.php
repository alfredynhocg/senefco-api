<?php

namespace App\Application\TramitesCatalogo\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetTramitesQuery
{
    public function __construct(
        public PaginationDTO $pagination,
        public bool $soloActivos = false,
        public ?int $tipoTramiteId = null,
    ) {}
}
