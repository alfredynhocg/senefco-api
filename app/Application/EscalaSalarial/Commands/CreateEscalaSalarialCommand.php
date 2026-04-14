<?php

namespace App\Application\EscalaSalarial\Commands;

final readonly class CreateEscalaSalarialCommand
{
    public function __construct(
        public string $nivel,
        public string $descripcion_cargo,
        public float $sueldo_basico,
        public ?string $categoria = null,
    ) {}
}
