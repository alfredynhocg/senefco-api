<?php

namespace App\Application\NominaPersonal\Commands;

final readonly class UpdateNominaPersonalCommand
{
    public function __construct(public int $id, public array $data) {}
}
