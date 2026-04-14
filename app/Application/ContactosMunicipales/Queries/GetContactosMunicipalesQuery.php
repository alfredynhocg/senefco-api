<?php

namespace App\Application\ContactosMunicipales\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetContactosMunicipalesQuery
{
    public function __construct(public PaginationDTO $pagination) {}
}
