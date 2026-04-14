<?php

namespace App\Application\TiposTramite\Commands;

final readonly class UpdateTipoTramiteCommand
{
    public function __construct(public int $id, public array $data) {}
}
