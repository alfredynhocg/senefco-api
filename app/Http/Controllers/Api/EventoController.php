<?php

namespace App\Http\Controllers\Api;

use App\Application\Eventos\Commands\CreateEventoCommand;
use App\Application\Eventos\Commands\DeleteEventoCommand;
use App\Application\Eventos\Commands\UpdateEventoCommand;
use App\Application\Eventos\Handlers\CreateEventoHandler;
use App\Application\Eventos\Handlers\DeleteEventoHandler;
use App\Application\Eventos\Handlers\UpdateEventoHandler;
use App\Application\Eventos\Queries\GetEventoByIdQuery;
use App\Application\Eventos\Queries\GetEventosQuery;
use App\Application\Eventos\QueryHandlers\GetEventoByIdQueryHandler;
use App\Application\Eventos\QueryHandlers\GetEventosQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Eventos\StoreEventoRequest;
use App\Http\Requests\Eventos\UpdateEventoRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function __construct(
        private readonly GetEventosQueryHandler $getEventosHandler,
        private readonly GetEventoByIdQueryHandler $getEventoByIdHandler,
        private readonly CreateEventoHandler $createHandler,
        private readonly UpdateEventoHandler $updateHandler,
        private readonly DeleteEventoHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 15),
            'query' => $request->get('query', ''),
            'sortKey' => $request->input('sort.key', 'fecha_inicio'),
            'sortOrder' => $request->input('sort.order', 'desc'),
        ]);

        return response()->json(
            $this->getEventosHandler->handle(
                new GetEventosQuery($pagination, $request->boolean('soloActivos', false))
            )
        );
    }

    public function store(StoreEventoRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateEventoCommand(
            tipo_evento_id: (int) $request->tipo_evento_id,
            creado_por: auth()->id(),
            titulo: $request->titulo,
            descripcion: $request->descripcion,
            lugar: $request->lugar,
            latitud: $request->latitud ? (float) $request->latitud : null,
            longitud: $request->longitud ? (float) $request->longitud : null,
            fecha_inicio: $request->fecha_inicio,
            fecha_fin: $request->fecha_fin,
            todo_el_dia: $request->boolean('todo_el_dia', false),
            estado: $request->input('estado', 'programado'),
            url_transmision: $request->url_transmision,
            publico: $request->boolean('publico', true),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getEventoByIdHandler->handle(new GetEventoByIdQuery($id)));
    }

    public function update(UpdateEventoRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateEventoCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteEventoCommand($id));

        return response()->json(null, 204);
    }
}
