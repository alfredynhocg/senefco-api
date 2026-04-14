<?php

namespace App\Http\Controllers\Api;

use App\Application\RequisitosTramite\Commands\CreateRequisitoCommand;
use App\Application\RequisitosTramite\Commands\DeleteRequisitoCommand;
use App\Application\RequisitosTramite\Commands\UpdateRequisitoCommand;
use App\Application\RequisitosTramite\Handlers\CreateRequisitoHandler;
use App\Application\RequisitosTramite\Handlers\DeleteRequisitoHandler;
use App\Application\RequisitosTramite\Handlers\UpdateRequisitoHandler;
use App\Application\RequisitosTramite\Queries\GetRequisitoByIdQuery;
use App\Application\RequisitosTramite\Queries\GetRequisitosByTramiteQuery;
use App\Application\RequisitosTramite\QueryHandlers\GetRequisitoByIdQueryHandler;
use App\Application\RequisitosTramite\QueryHandlers\GetRequisitosByTramiteQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequisitosTramite\StoreRequisitoRequest;
use App\Http\Requests\RequisitosTramite\UpdateRequisitoRequest;
use Illuminate\Http\JsonResponse;

class RequisitoController extends Controller
{
    public function __construct(
        private readonly GetRequisitosByTramiteQueryHandler $getByTramiteHandler,
        private readonly GetRequisitoByIdQueryHandler $getByIdHandler,
        private readonly CreateRequisitoHandler $createHandler,
        private readonly UpdateRequisitoHandler $updateHandler,
        private readonly DeleteRequisitoHandler $deleteHandler,
    ) {}

    public function index(int $tramiteId): JsonResponse
    {
        return response()->json($this->getByTramiteHandler->handle(new GetRequisitosByTramiteQuery($tramiteId)));
    }

    public function store(StoreRequisitoRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateRequisitoCommand(
            tramite_id: $request->tramite_id,
            nombre: $request->nombre,
            descripcion: $request->descripcion,
            obligatorio: $request->boolean('obligatorio', true),
            tipo: $request->get('tipo', 'documento'),
            orden: $request->integer('orden', 0),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getByIdHandler->handle(new GetRequisitoByIdQuery($id)));
    }

    public function update(UpdateRequisitoRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateRequisitoCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteRequisitoCommand($id));

        return response()->json(null, 204);
    }
}
