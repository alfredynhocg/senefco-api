<?php

namespace App\Http\Controllers\Api;

use App\Application\ContactosMunicipales\Commands\CreateContactoMunicipalCommand;
use App\Application\ContactosMunicipales\Commands\DeleteContactoMunicipalCommand;
use App\Application\ContactosMunicipales\Commands\UpdateContactoMunicipalCommand;
use App\Application\ContactosMunicipales\Handlers\CreateContactoMunicipalHandler;
use App\Application\ContactosMunicipales\Handlers\DeleteContactoMunicipalHandler;
use App\Application\ContactosMunicipales\Handlers\UpdateContactoMunicipalHandler;
use App\Application\ContactosMunicipales\Queries\GetContactoMunicipalByIdQuery;
use App\Application\ContactosMunicipales\Queries\GetContactosMunicipalesQuery;
use App\Application\ContactosMunicipales\QueryHandlers\GetContactoMunicipalByIdQueryHandler;
use App\Application\ContactosMunicipales\QueryHandlers\GetContactosMunicipalesQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactosMunicipales\StoreContactoMunicipalRequest;
use App\Http\Requests\ContactosMunicipales\UpdateContactoMunicipalRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactoMunicipalController extends Controller
{
    public function __construct(
        private readonly GetContactosMunicipalesQueryHandler $getContactosHandler,
        private readonly GetContactoMunicipalByIdQueryHandler $getContactoByIdHandler,
        private readonly CreateContactoMunicipalHandler $createHandler,
        private readonly UpdateContactoMunicipalHandler $updateHandler,
        private readonly DeleteContactoMunicipalHandler $deleteHandler,
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
            $this->getContactosHandler->handle(new GetContactosMunicipalesQuery($pagination))
        );
    }

    public function store(StoreContactoMunicipalRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateContactoMunicipalCommand(
            nombre_area: $request->nombre_area,
            telefono: $request->telefono,
            interno: $request->interno,
            encargado: $request->encargado,
            orden: $request->integer('orden', 0),
            activo: $request->boolean('activo', true),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getContactoByIdHandler->handle(new GetContactoMunicipalByIdQuery($id)));
    }

    public function update(UpdateContactoMunicipalRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateContactoMunicipalCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteContactoMunicipalCommand($id));

        return response()->json(null, 204);
    }
}
