<?php

namespace App\Http\Controllers\Api;

use App\Application\Subcenefcos\Commands\CreateSubcenefcoCommand;
use App\Application\Subcenefcos\Commands\DeleteSubcenefcoCommand;
use App\Application\Subcenefcos\Commands\UpdateSubcenefcoCommand;
use App\Application\Subcenefcos\Handlers\CreateSubcenefcoHandler;
use App\Application\Subcenefcos\Handlers\DeleteSubcenefcoHandler;
use App\Application\Subcenefcos\Handlers\UpdateSubcenefcoHandler;
use App\Application\Subcenefcos\Queries\GetSubcenefcoByIdQuery;
use App\Application\Subcenefcos\Queries\GetSubcenefcosQuery;
use App\Application\Subcenefcos\QueryHandlers\GetSubcenefcoByIdQueryHandler;
use App\Application\Subcenefcos\QueryHandlers\GetSubcenefcosQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subcenefcos\StoreSubcenefcoRequest;
use App\Http\Requests\Subcenefcos\UpdateSubcenefcoRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubcenefcoController extends Controller
{
    public function __construct(
        private readonly GetSubcenefcosQueryHandler $getSubcenefcosHandler,
        private readonly GetSubcenefcoByIdQueryHandler $getSubcenefcoByIdHandler,
        private readonly CreateSubcenefcoHandler $createHandler,
        private readonly UpdateSubcenefcoHandler $updateHandler,
        private readonly DeleteSubcenefcoHandler $deleteHandler,
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
            $this->getSubcenefcosHandler->handle(
                new GetSubcenefcosQuery($pagination, $request->boolean('soloActivos', false))
            )
        );
    }

    public function store(StoreSubcenefcoRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateSubcenefcoCommand(
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
        return response()->json($this->getSubcenefcoByIdHandler->handle(new GetSubcenefcoByIdQuery($id)));
    }

    public function update(UpdateSubcenefcoRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateSubcenefcoCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteSubcenefcoCommand($id));

        return response()->json(null, 204);
    }
}
