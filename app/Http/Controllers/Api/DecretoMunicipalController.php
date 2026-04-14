<?php

namespace App\Http\Controllers\Api;

use App\Application\DecretosMunicipales\Commands\CreateDecretoMunicipalCommand;
use App\Application\DecretosMunicipales\Commands\DeleteDecretoMunicipalCommand;
use App\Application\DecretosMunicipales\Commands\UpdateDecretoMunicipalCommand;
use App\Application\DecretosMunicipales\Handlers\CreateDecretoMunicipalHandler;
use App\Application\DecretosMunicipales\Handlers\DeleteDecretoMunicipalHandler;
use App\Application\DecretosMunicipales\Handlers\UpdateDecretoMunicipalHandler;
use App\Application\DecretosMunicipales\Queries\GetDecretoMunicipalByIdQuery;
use App\Application\DecretosMunicipales\Queries\GetDecretosMunicipalesQuery;
use App\Application\DecretosMunicipales\QueryHandlers\GetDecretoMunicipalByIdQueryHandler;
use App\Application\DecretosMunicipales\QueryHandlers\GetDecretosMunicipalesQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\DecretosMunicipales\StoreDecretoMunicipalRequest;
use App\Http\Requests\DecretosMunicipales\UpdateDecretoMunicipalRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DecretoMunicipalController extends Controller
{
    public function __construct(
        private readonly GetDecretosMunicipalesQueryHandler $getDecretosHandler,
        private readonly GetDecretoMunicipalByIdQueryHandler $getDecretoByIdHandler,
        private readonly CreateDecretoMunicipalHandler $createHandler,
        private readonly UpdateDecretoMunicipalHandler $updateHandler,
        private readonly DeleteDecretoMunicipalHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize'  => $request->get('pageSize', 15),
            'query'     => $request->get('query', ''),
            'sortKey'   => $request->input('sort.key', 'created_at'),
            'sortOrder' => $request->input('sort.order', 'desc'),
        ]);

        return response()->json(
            $this->getDecretosHandler->handle(
                new GetDecretosMunicipalesQuery(
                    $pagination,
                    $request->boolean('soloPublicados', false),
                    $request->get('tipo'),
                )
            )
        );
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(
            $this->getDecretoByIdHandler->handle(new GetDecretoMunicipalByIdQuery($id))
        );
    }

    public function store(StoreDecretoMunicipalRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateDecretoMunicipalCommand(
            numero:             $request->numero,
            tipo:               $request->tipo ?? 'decreto',
            titulo:             $request->titulo,
            descripcion:        $request->descripcion,
            pdf_url:            $request->pdf_url,
            pdf_nombre:         $request->pdf_nombre,
            estado:             $request->estado ?? 'borrador',
            fecha_promulgacion: $request->fecha_promulgacion,
            anio:               (int) $request->anio,
            publicado_en_web:   $request->boolean('publicado_en_web', false),
            publicado_por:      auth()->id(),
        ));

        return response()->json($dto, 201);
    }

    public function update(UpdateDecretoMunicipalRequest $request, int $id): JsonResponse
    {
        return response()->json(
            $this->updateHandler->handle(new UpdateDecretoMunicipalCommand(
                id:   $id,
                data: $request->validated(),
            ))
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteDecretoMunicipalCommand($id));

        return response()->json(null, 204);
    }
}
