<?php

namespace App\Application\UnidadesResponsables\Commands;

final readonly class DeleteUnidadResponsableCommand
{
    public function __construct(public int $id) {}
}
