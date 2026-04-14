<?php

namespace App\Http\Controllers\Api;

use App\Application\POA\Commands\CreatePOACommand;
use App\Application\POA\Handlers\CreatePOAHandler;
use App\Application\POA\Queries\GetAllPOAQuery;
use App\Application\POA\QueryHandlers\GetAllPOAQueryHandler;
use App\Application\ProgramasPOA\Commands\CreateProgramaPOACommand;
use App\Application\ProgramasPOA\Handlers\CreateProgramaPOAHandler;
use App\Application\ProgramasPOA\Queries\GetProgramasByPOAQuery;
use App\Application\ProgramasPOA\QueryHandlers\GetProgramasByPOAQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\POA\StorePOARequest;
use App\Http\Requests\ProgramasPOA\StoreProgramaPOARequest;
use Illuminate\Http\JsonResponse;

class POAController extends Controller
{
    public function __construct(
        private readonly GetAllPOAQueryHandler $getAllPoaHandler,
        private readonly CreatePOAHandler $createPoaHandler,
        private readonly GetProgramasByPOAQueryHandler $getProgramasHandler,
        private readonly CreateProgramaPOAHandler $createProgramaHandler,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->getAllPoaHandler->handle(new GetAllPOAQuery));
    }

    public function store(StorePOARequest $request): JsonResponse
    {
        $dto = $this->createPoaHandler->handle(new CreatePOACommand(
            plan_gobierno_id: (int) $request->plan_gobierno_id,
            secretaria_id: (int) $request->secretaria_id,
            gestion: (int) $request->gestion,
            titulo: $request->titulo,
            documento_pdf_url: $request->documento_pdf_url,
            resumen_ejecutivo_url: $request->resumen_ejecutivo_url,
            estado: $request->get('estado', 'borrador'),
            aprobado_por: auth()->id(),
            fecha_aprobacion: $request->fecha_aprobacion,
        ));

        return response()->json($dto, 201);
    }

    public function indexProgramas(int $poaId): JsonResponse
    {
        return response()->json($this->getProgramasHandler->handle(new GetProgramasByPOAQuery($poaId)));
    }

    public function storePrograma(StoreProgramaPOARequest $request): JsonResponse
    {
        $dto = $this->createProgramaHandler->handle(new CreateProgramaPOACommand(
            poa_id: (int) $request->poa_id,
            nombre: $request->nombre,
            descripcion: $request->descripcion,
            presupuesto_asignado: $request->presupuesto_asignado ? (float) $request->presupuesto_asignado : null,
            meta_indicador: $request->meta_indicador ? (int) $request->meta_indicador : null,
            unidad_medida: $request->unidad_medida,
            estado: $request->get('estado', 'no_iniciado'),
        ));

        return response()->json($dto, 201);
    }
}
