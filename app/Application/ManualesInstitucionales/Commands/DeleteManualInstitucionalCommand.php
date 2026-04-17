<?php

namespace App\Application\ManualesInstitucionales\Commands;

final readonly class DeleteManualInstitucionalCommand
{
    public function __construct(public int $id) {}
}
