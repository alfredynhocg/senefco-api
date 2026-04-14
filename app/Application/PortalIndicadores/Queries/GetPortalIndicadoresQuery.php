<?php

namespace App\Application\PortalIndicadores\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetPortalIndicadoresQuery
{
    public function __construct(
        public PaginationDTO $pagination,
        public ?string $categoria = null,
        public ?string $estado = null,
    ) {}
}
