<?php

namespace App\Application\Autoridades\Commands;

final readonly class UpdateAutoridadCommand
{
    public function __construct(public int $id, public array $data) {}
}
