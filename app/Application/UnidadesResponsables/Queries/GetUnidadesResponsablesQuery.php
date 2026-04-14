<?php

namespace App\Application\UnidadesResponsables\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetUnidadesResponsablesQuery
{
    public function __construct(public PaginationDTO $pagination) {}
}
