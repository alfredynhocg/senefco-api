<?php

namespace App\Application\InformesAuditoria\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetInformesAuditoriaQuery
{
    public function __construct(
        public PaginationDTO $pagination,
        public bool $soloPublicados = false,
    ) {}
}
