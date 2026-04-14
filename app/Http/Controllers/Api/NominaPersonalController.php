<?php

namespace App\Http\Controllers\Api;

use App\Application\NominaPersonal\Commands\CreateNominaPersonalCommand;
use App\Application\NominaPersonal\Commands\DeleteNominaPersonalCommand;
use App\Application\NominaPersonal\Commands\UpdateNominaPersonalCommand;
use App\Application\NominaPersonal\Handlers\CreateNominaPersonalHandler;
use App\Application\NominaPersonal\Handlers\DeleteNominaPersonalHandler;
use App\Application\NominaPersonal\Handlers\UpdateNominaPersonalHandler;
use App\Application\NominaPersonal\Queries\GetNominaPersonalByIdQuery;
use App\Application\NominaPersonal\Queries\GetNominaPersonalQuery;
use App\Application\NominaPersonal\QueryHandlers\GetNominaPersonalByIdQueryHandler;
use App\Application\NominaPersonal\QueryHandlers\GetNominaPersonalQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\NominaPersonal\StoreNominaPersonalRequest;
use App\Http\Requests\NominaPersonal\UpdateNominaPersonalRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NominaPersonalController extends Controller
{
    public function __construct(
        private readonly GetNominaPersonalQueryHandler $getNominaHandler,
        private readonly GetNominaPersonalByIdQueryHandler $getNominaByIdHandler,
        private readonly CreateNominaPersonalHandler $createHandler,
        private readonly UpdateNominaPersonalHandler $updateHandler,
        private readonly DeleteNominaPersonalHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 20),
            'query' => $request->get('query', ''),
            'sortKey' => $request->input('sort.key', 'apellido'),
            'sortOrder' => $request->input('sort.order', 'asc'),
        ]);

        return response()->json(
            $this->getNominaHandler->handle(
                new GetNominaPersonalQuery($pagination, $request->boolean('soloActivos', false))
            )
        );
    }

    public function store(StoreNominaPersonalRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateNominaPersonalCommand(
            secretaria_id: (int) $request->secretaria_id,
            nombre: $request->nombre,
            apellido: $request->apellido,
            cargo: $request->cargo,
            gestion: (int) $request->gestion,
            ci: $request->ci,
            nivel_salarial: $request->nivel_salarial,
            tipo_contrato: $request->get('tipo_contrato', 'planta'),
            activo: $request->boolean('activo', true),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getNominaByIdHandler->handle(new GetNominaPersonalByIdQuery($id)));
    }

    public function update(UpdateNominaPersonalRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateNominaPersonalCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteNominaPersonalCommand($id));

        return response()->json(null, 204);
    }
}
