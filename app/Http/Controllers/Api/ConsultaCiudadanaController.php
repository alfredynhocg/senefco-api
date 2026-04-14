<?php

namespace App\Http\Controllers\Api;

use App\Application\ConsultasCiudadanas\Commands\CreateConsultaCiudadanaCommand;
use App\Application\ConsultasCiudadanas\Commands\DeleteConsultaCiudadanaCommand;
use App\Application\ConsultasCiudadanas\Commands\ResponderConsultaCommand;
use App\Application\ConsultasCiudadanas\Handlers\CreateConsultaCiudadanaHandler;
use App\Application\ConsultasCiudadanas\Handlers\DeleteConsultaCiudadanaHandler;
use App\Application\ConsultasCiudadanas\Handlers\ResponderConsultaHandler;
use App\Application\ConsultasCiudadanas\Queries\GetConsultaCiudadanaByIdQuery;
use App\Application\ConsultasCiudadanas\Queries\GetConsultasCiudadanasQuery;
use App\Application\ConsultasCiudadanas\QueryHandlers\GetConsultaCiudadanaByIdQueryHandler;
use App\Application\ConsultasCiudadanas\QueryHandlers\GetConsultasCiudadanasQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultasCiudadanas\ResponderConsultaRequest;
use App\Http\Requests\ConsultasCiudadanas\StoreConsultaCiudadanaRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConsultaCiudadanaController extends Controller
{
    public function __construct(
        private readonly GetConsultasCiudadanasQueryHandler $getListHandler,
        private readonly GetConsultaCiudadanaByIdQueryHandler $getByIdHandler,
        private readonly CreateConsultaCiudadanaHandler $createHandler,
        private readonly ResponderConsultaHandler $responderHandler,
        private readonly DeleteConsultaCiudadanaHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $result = $this->getListHandler->handle(new GetConsultasCiudadanasQuery(
            pageIndex: (int) $request->get('pageIndex', 1),
            pageSize: (int) $request->get('pageSize', 10),
            query: (string) $request->get('query', ''),
            tipo: (string) $request->get('tipo', ''),
            estado: (string) $request->get('estado', ''),
        ));

        return response()->json($result);
    }

    public function show(int $id): JsonResponse
    {
        $dto = $this->getByIdHandler->handle(new GetConsultaCiudadanaByIdQuery($id));

        return response()->json($dto);
    }

    public function store(StoreConsultaCiudadanaRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateConsultaCiudadanaCommand(
            ciudadano_nombre: $request->ciudadano_nombre,
            ciudadano_ci: $request->ciudadano_ci,
            ciudadano_email: $request->ciudadano_email,
            ciudadano_telefono: $request->ciudadano_telefono,
            tipo: $request->tipo,
            asunto: $request->asunto,
            descripcion: $request->descripcion,
            estado: $request->estado ?? 'pendiente',
        ));

        return response()->json($dto, 201);
    }

    public function responder(ResponderConsultaRequest $request, int $id): JsonResponse
    {
        $dto = $this->responderHandler->handle(new ResponderConsultaCommand(
            id: $id,
            respuesta: $request->respuesta,
            estado: $request->estado,
        ));

        return response()->json($dto);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteConsultaCiudadanaCommand($id));

        return response()->json(null, 204);
    }
}
