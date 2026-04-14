<?php

namespace App\Application\NominaPersonal\Commands;

final readonly class DeleteNominaPersonalCommand
{
    public function __construct(public int $id) {}
}
