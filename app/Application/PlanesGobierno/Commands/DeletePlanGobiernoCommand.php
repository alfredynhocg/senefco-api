<?php

namespace App\Application\PlanesGobierno\Commands;

final readonly class DeletePlanGobiernoCommand
{
    public function __construct(public int $id) {}
}
