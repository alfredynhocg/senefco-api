<?php

namespace App\Application\PortalIndicadores\Commands;

final readonly class DeletePortalIndicadorCommand
{
    public function __construct(public int $id) {}
}
