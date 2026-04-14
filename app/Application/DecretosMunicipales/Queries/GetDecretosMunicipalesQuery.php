<?php

namespace App\Application\DecretosMunicipales\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetDecretosMunicipalesQuery
{
    public function __construct(
        public PaginationDTO $pagination,
        public bool $soloPublicados = false,
        public ?string $tipo = null,
    ) {}
}
