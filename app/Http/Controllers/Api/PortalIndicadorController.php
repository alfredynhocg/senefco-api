<?php

namespace App\Http\Controllers\Api;

use App\Application\PortalIndicadores\Commands\CreatePortalIndicadorCommand;
use App\Application\PortalIndicadores\Commands\DeletePortalIndicadorCommand;
use App\Application\PortalIndicadores\Commands\UpdatePortalIndicadorCommand;
use App\Application\PortalIndicadores\Handlers\CreatePortalIndicadorHandler;
use App\Application\PortalIndicadores\Handlers\DeletePortalIndicadorHandler;
use App\Application\PortalIndicadores\Handlers\UpdatePortalIndicadorHandler;
use App\Application\PortalIndicadores\Queries\GetPortalIndicadorByIdQuery;
use App\Application\PortalIndicadores\Queries\GetPortalIndicadoresQuery;
use App\Application\PortalIndicadores\QueryHandlers\GetPortalIndicadorByIdQueryHandler;
use App\Application\PortalIndicadores\QueryHandlers\GetPortalIndicadoresQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\PortalIndicadores\StorePortalIndicadorRequest;
use App\Http\Requests\PortalIndicadores\UpdatePortalIndicadorRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PortalIndicadorController extends Controller
{
    public function __construct(
        private readonly GetPortalIndicadoresQueryHandler $getListHandler,
        private readonly GetPortalIndicadorByIdQueryHandler $getByIdHandler,
        private readonly CreatePortalIndicadorHandler $createHandler,
        private readonly UpdatePortalIndicadorHandler $updateHandler,
        private readonly DeletePortalIndicadorHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 15),
            'query' => $request->get('query', ''),
        ]);

        return response()->json(
            $this->getListHandler->handle(new GetPortalIndicadoresQuery(
                $pagination,
                $request->get('categoria'),
                $request->get('estado'),
            ))
        );
    }

    public function store(StorePortalIndicadorRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreatePortalIndicadorCommand(
            nombre: $request->nombre,
            descripcion: $request->descripcion,
            categoria: $request->input('categoria', 'otro'),
            unidad: $request->input('unidad', '%'),
            meta: $request->meta !== null ? (float) $request->meta : null,
            valor_actual: $request->valor_actual !== null ? (float) $request->valor_actual : null,
            periodo: $request->periodo,
            fecha_medicion: $request->fecha_medicion,
            estado: $request->input('estado', 'sin_dato'),
            responsable: $request->responsable,
            publicado: $request->boolean('publicado', false),
            activo: $request->boolean('activo', true),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getByIdHandler->handle(new GetPortalIndicadorByIdQuery($id)));
    }

    public function update(UpdatePortalIndicadorRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdatePortalIndicadorCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeletePortalIndicadorCommand($id));

        return response()->json(null, 204);
    }
}
