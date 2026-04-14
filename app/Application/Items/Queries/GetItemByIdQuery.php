<?php

namespace App\Application\Items\Queries;

final readonly class GetItemByIdQuery
{
    public function __construct(public int $id) {}
}
