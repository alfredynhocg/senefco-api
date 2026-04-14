<?php

namespace App\Application\UnidadesResponsables\DTOs;

final readonly class UnidadResponsableDTO
{
    public function __construct(
        public int $id,
        public int $secretaria_id,
        public string $nombre,
        public ?string $direccion,
        public ?string $telefono,
        public ?string $email,
        public ?string $horario,
        public bool $activa,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            secretaria_id: (int) $model->secretaria_id,
            nombre: $model->nombre,
            direccion: $model->direccion,
            telefono: $model->telefono,
            email: $model->email,
            horario: $model->horario,
            activa: (bool) $model->activa,
        );
    }
}
