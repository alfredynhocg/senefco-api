<?php

namespace App\Http\Controllers\Api;

use App\Application\RedesSociales\Commands\CreateRedSocialCommand;
use App\Application\RedesSociales\Commands\DeleteRedSocialCommand;
use App\Application\RedesSociales\Commands\UpdateRedSocialCommand;
use App\Application\RedesSociales\Handlers\CreateRedSocialHandler;
use App\Application\RedesSociales\Handlers\DeleteRedSocialHandler;
use App\Application\RedesSociales\Handlers\UpdateRedSocialHandler;
use App\Application\RedesSociales\Queries\GetRedSocialByIdQuery;
use App\Application\RedesSociales\Queries\GetRedSocialQuery;
use App\Application\RedesSociales\QueryHandlers\GetRedSocialByIdQueryHandler;
use App\Application\RedesSociales\QueryHandlers\GetRedSocialQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\RedesSociales\StoreRedSocialRequest;
use App\Http\Requests\RedesSociales\UpdateRedSocialRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RedSocialController extends Controller
{
    public function __construct(
        private readonly GetRedSocialQueryHandler $getRedSocialsHandler,
        private readonly GetRedSocialByIdQueryHandler $getRedSocialByIdHandler,
        private readonly CreateRedSocialHandler $createHandler,
        private readonly UpdateRedSocialHandler $updateHandler,
        private readonly DeleteRedSocialHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 10),
            'query' => $request->get('query', ''),
            'sortKey' => $request->input('sort.key', 'orden'),
            'sortOrder' => $request->input('sort.order', 'asc'),
        ]);

        return response()->json(
            $this->getRedSocialsHandler->handle(new GetRedSocialQuery($pagination))
        );
    }

    public function store(StoreRedSocialRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateRedSocialCommand(
            plataforma: $request->plataforma,
            url: $request->url,
            nombre_cuenta: $request->nombre_cuenta,
            icono_clase: $request->icono_clase,
            activo: $request->boolean('activo', true),
            orden: (int) $request->input('orden', 0),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(
            $this->getRedSocialByIdHandler->handle(new GetRedSocialByIdQuery($id))
        );
    }

    public function update(UpdateRedSocialRequest $request, int $id): JsonResponse
    {
        return response()->json(
            $this->updateHandler->handle(new UpdateRedSocialCommand($id, $request->validated()))
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteRedSocialCommand($id));

        return response()->json(null, 204);
    }
}
