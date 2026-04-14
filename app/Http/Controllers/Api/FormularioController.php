<?php

namespace App\Http\Controllers\Api;

use App\Application\FormulariosTramite\Commands\CreateFormularioCommand;
use App\Application\FormulariosTramite\Commands\DeleteFormularioCommand;
use App\Application\FormulariosTramite\Commands\UpdateFormularioCommand;
use App\Application\FormulariosTramite\Handlers\CreateFormularioHandler;
use App\Application\FormulariosTramite\Handlers\DeleteFormularioHandler;
use App\Application\FormulariosTramite\Handlers\UpdateFormularioHandler;
use App\Application\FormulariosTramite\Queries\GetFormularioByIdQuery;
use App\Application\FormulariosTramite\Queries\GetFormulariosByTramiteQuery;
use App\Application\FormulariosTramite\QueryHandlers\GetFormularioByIdQueryHandler;
use App\Application\FormulariosTramite\QueryHandlers\GetFormulariosByTramiteQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormulariosTramite\StoreFormularioRequest;
use App\Http\Requests\FormulariosTramite\UpdateFormularioRequest;
use Illuminate\Http\JsonResponse;

class FormularioController extends Controller
{
    public function __construct(
        private readonly GetFormulariosByTramiteQueryHandler $getByTramiteHandler,
        private readonly GetFormularioByIdQueryHandler $getByIdHandler,
        private readonly CreateFormularioHandler $createHandler,
        private readonly UpdateFormularioHandler $updateHandler,
        private readonly DeleteFormularioHandler $deleteHandler,
    ) {}

    public function index(int $tramiteId): JsonResponse
    {
        return response()->json($this->getByTramiteHandler->handle(new GetFormulariosByTramiteQuery($tramiteId)));
    }

    public function store(StoreFormularioRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateFormularioCommand(
            tramite_id: $request->tramite_id,
            nombre: $request->nombre,
            archivo_url: $request->archivo_url,
            formato: $request->get('formato', 'PDF'),
            fecha_actualizacion: $request->fecha_actualizacion,
            activo: $request->boolean('activo', true),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getByIdHandler->handle(new GetFormularioByIdQuery($id)));
    }

    public function update(UpdateFormularioRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateFormularioCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteFormularioCommand($id));

        return response()->json(null, 204);
    }
}
