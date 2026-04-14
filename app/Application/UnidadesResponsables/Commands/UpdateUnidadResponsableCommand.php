<?php

namespace App\Application\UnidadesResponsables\Commands;

final readonly class UpdateUnidadResponsableCommand
{
    public function __construct(public int $id, public array $data) {}
}
