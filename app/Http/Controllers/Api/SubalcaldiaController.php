<?php

namespace App\Http\Controllers\Api;

use App\Application\Subsenefcos\Commands\CreateSubsenefcoCommand;
use App\Application\Subsenefcos\Commands\DeleteSubsenefcoCommand;
use App\Application\Subsenefcos\Commands\UpdateSubsenefcoCommand;
use App\Application\Subsenefcos\Handlers\CreateSubsenefcoHandler;
use App\Application\Subsenefcos\Handlers\DeleteSubsenefcoHandler;
use App\Application\Subsenefcos\Handlers\UpdateSubsenefcoHandler;
use App\Application\Subsenefcos\Queries\GetSubsenefcoByIdQuery;
use App\Application\Subsenefcos\Queries\GetSubsenefcosQuery;
use App\Application\Subsenefcos\QueryHandlers\GetSubsenefcoByIdQueryHandler;
use App\Application\Subsenefcos\QueryHandlers\GetSubsenefcosQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subsenefcos\StoreSubsenefcoRequest;
use App\Http\Requests\Subsenefcos\UpdateSubsenefcoRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubsenefcoController extends Controller
{
    public function __construct(
        private readonly GetSubsenefcosQueryHandler $getSubsenefcosHandler,
        private readonly GetSubsenefcoByIdQueryHandler $getSubsenefcoByIdHandler,
        private readonly CreateSubsenefcoHandler $createHandler,
        private readonly UpdateSubsenefcoHandler $updateHandler,
        private readonly DeleteSubsenefcoHandler $deleteHandler,
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
            $this->getSubsenefcosHandler->handle(
                new GetSubsenefcosQuery($pagination, $request->boolean('soloActivos', false))
            )
        );
    }

    public function store(StoreSubsenefcoRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateSubsenefcoCommand(
            nombre: $request->nombre,
            zona_cobertura: $request->zona_cobertura,
            direccion_fisica: $request->direccion_fisica,
            telefono: $request->telefono,
            email: $request->email,
            imagen_url: $request->imagen_url,
            latitud: $request->latitud ? (float) $request->latitud : null,
            longitud: $request->longitud ? (float) $request->longitud : null,
            tramites_disponibles: $request->tramites_disponibles,
            activa: $request->boolean('activa', true),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getSubsenefcoByIdHandler->handle(new GetSubsenefcoByIdQuery($id)));
    }

    public function update(UpdateSubsenefcoRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateSubsenefcoCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteSubsenefcoCommand($id));

        return response()->json(null, 204);
    }
}
