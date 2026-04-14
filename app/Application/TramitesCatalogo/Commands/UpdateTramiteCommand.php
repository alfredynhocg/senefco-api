<?php

namespace App\Application\TramitesCatalogo\Commands;

final readonly class UpdateTramiteCommand
{
    public function __construct(public int $id, public array $data) {}
}
