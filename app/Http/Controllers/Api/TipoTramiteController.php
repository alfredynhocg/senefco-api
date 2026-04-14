<?php

namespace App\Http\Controllers\Api;

use App\Application\TiposTramite\Commands\CreateTipoTramiteCommand;
use App\Application\TiposTramite\Commands\DeleteTipoTramiteCommand;
use App\Application\TiposTramite\Commands\UpdateTipoTramiteCommand;
use App\Application\TiposTramite\Handlers\CreateTipoTramiteHandler;
use App\Application\TiposTramite\Handlers\DeleteTipoTramiteHandler;
use App\Application\TiposTramite\Handlers\UpdateTipoTramiteHandler;
use App\Application\TiposTramite\Queries\GetTiposTramiteQuery;
use App\Application\TiposTramite\Queries\GetTipoTramiteByIdQuery;
use App\Application\TiposTramite\QueryHandlers\GetTiposTramiteQueryHandler;
use App\Application\TiposTramite\QueryHandlers\GetTipoTramiteByIdQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\TiposTramite\StoreTipoTramiteRequest;
use App\Http\Requests\TiposTramite\UpdateTipoTramiteRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TipoTramiteController extends Controller
{
    public function __construct(
        private readonly GetTiposTramiteQueryHandler $getTiposHandler,
        private readonly GetTipoTramiteByIdQueryHandler $getTipoByIdHandler,
        private readonly CreateTipoTramiteHandler $createHandler,
        private readonly UpdateTipoTramiteHandler $updateHandler,
        private readonly DeleteTipoTramiteHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 100),
            'query' => $request->get('query', ''),
            'sortKey' => $request->input('sort.key', 'orden'),
            'sortOrder' => $request->input('sort.order', 'asc'),
        ]);

        return response()->json(
            $this->getTiposHandler->handle(new GetTiposTramiteQuery($pagination))
        );
    }

    public function store(StoreTipoTramiteRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateTipoTramiteCommand(
            nombre: $request->nombre,
            icono_url: $request->icono_url,
            color_hex: $request->color_hex,
            activo: $request->boolean('activo', true),
            orden: $request->integer('orden', 0),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getTipoByIdHandler->handle(new GetTipoTramiteByIdQuery($id)));
    }

    public function update(UpdateTipoTramiteRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateTipoTramiteCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteTipoTramiteCommand($id));

        return response()->json(null, 204);
    }
}
