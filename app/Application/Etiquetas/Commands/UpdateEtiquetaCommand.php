<?php

namespace App\Application\Etiquetas\Commands;

final readonly class UpdateEtiquetaCommand
{
    public function __construct(public int $id, public array $data) {}
}
