<?php

namespace App\Http\Controllers\Api;

use App\Application\Items\Commands\CreateItemCommand;
use App\Application\Items\Commands\DeleteItemCommand;
use App\Application\Items\Commands\UpdateItemCommand;
use App\Application\Items\Handlers\CreateItemHandler;
use App\Application\Items\Handlers\DeleteItemHandler;
use App\Application\Items\Handlers\UpdateItemHandler;
use App\Application\Items\Queries\GetItemByIdQuery;
use App\Application\Items\Queries\GetItemsQuery;
use App\Application\Items\QueryHandlers\GetItemByIdQueryHandler;
use App\Application\Items\QueryHandlers\GetItemsQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\StoreItemRequest;
use App\Http\Requests\Items\UpdateItemRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(
        private readonly GetItemsQueryHandler $getListHandler,
        private readonly GetItemByIdQueryHandler $getByIdHandler,
        private readonly CreateItemHandler $createHandler,
        private readonly UpdateItemHandler $updateHandler,
        private readonly DeleteItemHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 15),
            'query' => $request->get('query', ''),
        ]);

        return response()->json(
            $this->getListHandler->handle(new GetItemsQuery($pagination, $request->get('tipo')))
        );
    }

    public function store(StoreItemRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateItemCommand(
            nombre: $request->nombre,
            descripcion: $request->descripcion,
            tipo: $request->input('tipo', 'servicio'),
            precio: $request->precio !== null ? (float) $request->precio : null,
            imagen_url: $request->imagen_url,
            enlace_url: $request->enlace_url,
            orden: (int) $request->input('orden', 0),
            publicado: $request->boolean('publicado', false),
            activo: $request->boolean('activo', true),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getByIdHandler->handle(new GetItemByIdQuery($id)));
    }

    public function update(UpdateItemRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateItemCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteItemCommand($id));

        return response()->json(null, 204);
    }
}
