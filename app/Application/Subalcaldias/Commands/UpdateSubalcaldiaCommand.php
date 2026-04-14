<?php

namespace App\Application\Subsenefcos\Commands;

final readonly class UpdateSubsenefcoCommand
{
    public function __construct(public int $id, public array $data) {}
}
