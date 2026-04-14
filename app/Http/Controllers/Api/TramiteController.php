<?php

namespace App\Http\Controllers\Api;

use App\Application\TramitesCatalogo\Commands\CreateTramiteCommand;
use App\Application\TramitesCatalogo\Commands\DeleteTramiteCommand;
use App\Application\TramitesCatalogo\Commands\UpdateTramiteCommand;
use App\Application\TramitesCatalogo\Handlers\CreateTramiteHandler;
use App\Application\TramitesCatalogo\Handlers\DeleteTramiteHandler;
use App\Application\TramitesCatalogo\Handlers\UpdateTramiteHandler;
use App\Application\TramitesCatalogo\Queries\GetTramiteByIdQuery;
use App\Application\TramitesCatalogo\Queries\GetTramitesQuery;
use App\Application\TramitesCatalogo\QueryHandlers\GetTramiteByIdQueryHandler;
use App\Application\TramitesCatalogo\QueryHandlers\GetTramitesQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\TramitesCatalogo\StoreTramiteRequest;
use App\Http\Requests\TramitesCatalogo\UpdateTramiteRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TramiteController extends Controller
{
    public function __construct(
        private readonly GetTramitesQueryHandler $getTramitesHandler,
        private readonly GetTramiteByIdQueryHandler $getTramiteByIdHandler,
        private readonly CreateTramiteHandler $createHandler,
        private readonly UpdateTramiteHandler $updateHandler,
        private readonly DeleteTramiteHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 15),
            'query' => $request->get('query', ''),
            'sortKey' => $request->input('sort.key', 'nombre'),
            'sortOrder' => $request->input('sort.order', 'asc'),
        ]);

        return response()->json(
            $this->getTramitesHandler->handle(
                new GetTramitesQuery(
                    $pagination,
                    $request->boolean('soloActivos', false),
                    $request->integer('tipo_tramite_id') ?: null,
                )
            )
        );
    }

    public function store(StoreTramiteRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateTramiteCommand(
            tipo_tramite_id: $request->tipo_tramite_id,
            unidad_responsable_id: $request->unidad_responsable_id,
            creado_por: auth()->id(),
            nombre: $request->nombre,
            descripcion: $request->descripcion,
            procedimiento: $request->procedimiento,
            costo: $request->float('costo', 0),
            moneda: $request->get('moneda', 'BOB'),
            dias_habiles_resolucion: $request->integer('dias_habiles_resolucion'),
            normativa_base: $request->normativa_base,
            url_formulario: $request->url_formulario,
            modalidad: $request->get('modalidad', 'presencial'),
            activo: $request->boolean('activo', true),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getTramiteByIdHandler->handle(new GetTramiteByIdQuery($id)));
    }

    public function update(UpdateTramiteRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateTramiteCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteTramiteCommand($id));

        return response()->json(null, 204);
    }
}
