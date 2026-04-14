<?php

namespace App\Application\TiposTramite\Commands;

final readonly class DeleteTipoTramiteCommand
{
    public function __construct(public int $id) {}
}
