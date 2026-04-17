<?php

namespace App\Application\ManualesInstitucionales\Commands;

final readonly class UpdateManualInstitucionalCommand
{
    public function __construct(public int $id, public array $data) {}
}
