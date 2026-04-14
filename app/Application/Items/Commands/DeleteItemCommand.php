<?php

namespace App\Application\Items\Commands;

final readonly class DeleteItemCommand
{
    public function __construct(public int $id) {}
}
