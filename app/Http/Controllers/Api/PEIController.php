<?php

namespace App\Http\Controllers\Api;

use App\Application\EjesPEI\Commands\CreateEjePEICommand;
use App\Application\EjesPEI\Handlers\CreateEjePEIHandler;
use App\Application\EjesPEI\Queries\GetEjesByPEIQuery;
use App\Application\EjesPEI\QueryHandlers\GetEjesByPEIQueryHandler;
use App\Application\PEI\Commands\CreatePEICommand;
use App\Application\PEI\Handlers\CreatePEIHandler;
use App\Application\PEI\Queries\GetAllPEIQuery;
use App\Application\PEI\QueryHandlers\GetAllPEIQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\EjesPEI\StoreEjeRequest;
use App\Http\Requests\PEI\StorePEIRequest;
use Illuminate\Http\JsonResponse;

class PEIController extends Controller
{
    public function __construct(
        private readonly GetAllPEIQueryHandler $getAllHandler,
        private readonly CreatePEIHandler $createHandler,
        private readonly GetEjesByPEIQueryHandler $getEjesHandler,
        private readonly CreateEjePEIHandler $createEjeHandler,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->getAllHandler->handle(new GetAllPEIQuery));
    }

    public function store(StorePEIRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreatePEICommand(
            titulo: $request->titulo,
            anio_inicio: $request->anio_inicio,
            anio_fin: $request->anio_fin,
            descripcion: $request->descripcion,
            documento_pdf_url: $request->documento_pdf_url,
            estado: $request->get('estado', 'borrador'),
            aprobado_por: $request->user()?->id,
            fecha_aprobacion: $request->fecha_aprobacion,
            vigente: $request->boolean('vigente', true),
        ));

        return response()->json($dto, 201);
    }

    public function indexEjes(int $peiId): JsonResponse
    {
        return response()->json($this->getEjesHandler->handle(new GetEjesByPEIQuery($peiId)));
    }

    public function storeEje(StoreEjeRequest $request): JsonResponse
    {
        $dto = $this->createEjeHandler->handle(new CreateEjePEICommand(
            pei_id: $request->pei_id,
            numero_eje: $request->numero_eje,
            nombre: $request->nombre,
            descripcion: $request->descripcion,
            color_hex: $request->color_hex,
            total_objetivos: $request->get('total_objetivos', 0),
        ));

        return response()->json($dto, 201);
    }
}
