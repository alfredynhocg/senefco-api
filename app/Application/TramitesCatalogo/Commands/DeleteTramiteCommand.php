<?php

namespace App\Application\TramitesCatalogo\Commands;

final readonly class DeleteTramiteCommand
{
    public function __construct(public int $id) {}
}
