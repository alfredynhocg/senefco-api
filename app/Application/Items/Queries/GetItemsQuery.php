<?php

namespace App\Application\Items\Queries;

use App\Shared\Kernel\DTOs\PaginationDTO;

final readonly class GetItemsQuery
{
    public function __construct(
        public PaginationDTO $pagination,
        public ?string $tipo = null,
    ) {}
}
