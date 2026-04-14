<?php

namespace App\Http\Controllers\Api;

use App\Application\BannersPortal\Commands\CreateBannerPortalCommand;
use App\Application\BannersPortal\Commands\DeleteBannerPortalCommand;
use App\Application\BannersPortal\Commands\UpdateBannerPortalCommand;
use App\Application\BannersPortal\Handlers\CreateBannerPortalHandler;
use App\Application\BannersPortal\Handlers\DeleteBannerPortalHandler;
use App\Application\BannersPortal\Handlers\UpdateBannerPortalHandler;
use App\Application\BannersPortal\Queries\GetBannerPortalByIdQuery;
use App\Application\BannersPortal\Queries\GetBannersPortalQuery;
use App\Application\BannersPortal\QueryHandlers\GetBannerPortalByIdQueryHandler;
use App\Application\BannersPortal\QueryHandlers\GetBannersPortalQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannersPortal\StoreBannerPortalRequest;
use App\Http\Requests\BannersPortal\UpdateBannerPortalRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerPortalController extends Controller
{
    public function __construct(
        private readonly GetBannersPortalQueryHandler $getBannersHandler,
        private readonly GetBannerPortalByIdQueryHandler $getBannerByIdHandler,
        private readonly CreateBannerPortalHandler $createHandler,
        private readonly UpdateBannerPortalHandler $updateHandler,
        private readonly DeleteBannerPortalHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 20),
            'query' => $request->get('query', ''),
            'sortKey' => $request->input('sort.key', 'orden'),
            'sortOrder' => $request->input('sort.order', 'asc'),
        ]);

        return response()->json(
            $this->getBannersHandler->handle(
                new GetBannersPortalQuery($pagination, $request->boolean('soloActivos', false))
            )
        );
    }

    public function store(StoreBannerPortalRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateBannerPortalCommand(
            titulo: $request->titulo,
            descripcion: $request->descripcion,
            imagen_url: $request->imagen_url,
            enlace_url: $request->enlace_url,
            fecha_inicio: $request->fecha_inicio,
            fecha_fin: $request->fecha_fin,
            activo: $request->boolean('activo', true),
            orden: $request->integer('orden', 0),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getBannerByIdHandler->handle(new GetBannerPortalByIdQuery($id)));
    }

    public function update(UpdateBannerPortalRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateBannerPortalCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteBannerPortalCommand($id));

        return response()->json(null, 204);
    }
}
