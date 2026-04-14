<?php

namespace App\Application\TiposTramite\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetTiposTramiteQuery
{
    public function __construct(public PaginationDTO $pagination) {}
}
