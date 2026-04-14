<?php

namespace App\Application\Eventos\Handlers;

use App\Application\Eventos\Commands\CreateEventoCommand;
use App\Application\Eventos\DTOs\EventoDTO;
use App\Domain\Eventos\Contracts\EventoRepositoryInterface;

class CreateEventoHandler
{
    public function __construct(private readonly EventoRepositoryInterface $repository) {}

    public function handle(CreateEventoCommand $command): EventoDTO
    {
        return $this->repository->create([
            'tipo_evento_id' => $command->tipo_evento_id,
            'creado_por' => $command->creado_por,
            'titulo' => $command->titulo,
            'descripcion' => $command->descripcion,
            'lugar' => $command->lugar,
            'latitud' => $command->latitud,
            'longitud' => $command->longitud,
            'fecha_inicio' => $command->fecha_inicio,
            'fecha_fin' => $command->fecha_fin,
            'todo_el_dia' => $command->todo_el_dia,
            'estado' => $command->estado,
            'url_transmision' => $command->url_transmision,
            'publico' => $command->publico,
        ]);
    }
}
