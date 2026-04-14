<?php

namespace App\Http\Controllers\Api;

use App\Application\UnidadesResponsables\Commands\CreateUnidadResponsableCommand;
use App\Application\UnidadesResponsables\Commands\DeleteUnidadResponsableCommand;
use App\Application\UnidadesResponsables\Commands\UpdateUnidadResponsableCommand;
use App\Application\UnidadesResponsables\Handlers\CreateUnidadResponsableHandler;
use App\Application\UnidadesResponsables\Handlers\DeleteUnidadResponsableHandler;
use App\Application\UnidadesResponsables\Handlers\UpdateUnidadResponsableHandler;
use App\Application\UnidadesResponsables\Queries\GetUnidadesResponsablesQuery;
use App\Application\UnidadesResponsables\Queries\GetUnidadResponsableByIdQuery;
use App\Application\UnidadesResponsables\QueryHandlers\GetUnidadesResponsablesQueryHandler;
use App\Application\UnidadesResponsables\QueryHandlers\GetUnidadResponsableByIdQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnidadesResponsables\StoreUnidadResponsableRequest;
use App\Http\Requests\UnidadesResponsables\UpdateUnidadResponsableRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnidadResponsableController extends Controller
{
    public function __construct(
        private readonly GetUnidadesResponsablesQueryHandler $getUnidadesHandler,
        private readonly GetUnidadResponsableByIdQueryHandler $getUnidadByIdHandler,
        private readonly CreateUnidadResponsableHandler $createHandler,
        private readonly UpdateUnidadResponsableHandler $updateHandler,
        private readonly DeleteUnidadResponsableHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 50),
            'query' => $request->get('query', ''),
            'sortKey' => $request->input('sort.key', 'nombre'),
            'sortOrder' => $request->input('sort.order', 'asc'),
        ]);

        return response()->json(
            $this->getUnidadesHandler->handle(new GetUnidadesResponsablesQuery($pagination))
        );
    }

    public function store(StoreUnidadResponsableRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateUnidadResponsableCommand(
            secretaria_id: (int) $request->secretaria_id,
            nombre: $request->nombre,
            direccion: $request->direccion,
            telefono: $request->telefono,
            email: $request->email,
            horario: $request->horario,
            activa: $request->boolean('activa', true),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getUnidadByIdHandler->handle(new GetUnidadResponsableByIdQuery($id)));
    }

    public function update(UpdateUnidadResponsableRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateUnidadResponsableCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteUnidadResponsableCommand($id));

        return response()->json(null, 204);
    }
}
