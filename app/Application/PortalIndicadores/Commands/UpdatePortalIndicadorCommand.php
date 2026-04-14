<?php

namespace App\Application\PortalIndicadores\Commands;

final readonly class UpdatePortalIndicadorCommand
{
    public function __construct(public int $id, public array $data) {}
}
