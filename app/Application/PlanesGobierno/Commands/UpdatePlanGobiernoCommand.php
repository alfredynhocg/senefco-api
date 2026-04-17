<?php

namespace App\Application\PlanesGobierno\Commands;

final readonly class UpdatePlanGobiernoCommand
{
    public function __construct(public int $id, public array $data) {}
}
