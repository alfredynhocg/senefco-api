<?php

namespace App\Application\Items\Commands;

final readonly class UpdateItemCommand
{
    public function __construct(public int $id, public array $data) {}
}
