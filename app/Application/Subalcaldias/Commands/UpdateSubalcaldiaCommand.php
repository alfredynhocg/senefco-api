<?php

namespace App\Application\Subcenefcos\Commands;

final readonly class UpdateSubcenefcoCommand
{
    public function __construct(public int $id, public array $data) {}
}
