<?php

namespace App\Http\Controllers\Api;

use App\Application\EjecucionPresupuestaria\Commands\CreateEjecucionPresupuestariaCommand;
use App\Application\EjecucionPresupuestaria\Handlers\CreateEjecucionPresupuestariaHandler;
use App\Application\EjecucionPresupuestaria\Queries\GetEjecucionByPresupuestoQuery;
use App\Application\EjecucionPresupuestaria\QueryHandlers\GetEjecucionByPresupuestoQueryHandler;
use App\Application\PartidasPresupuestarias\Commands\CreatePartidaPresupuestariaCommand;
use App\Application\PartidasPresupuestarias\Handlers\CreatePartidaPresupuestariaHandler;
use App\Application\PartidasPresupuestarias\Queries\GetPartidasByPresupuestoQuery;
use App\Application\PartidasPresupuestarias\QueryHandlers\GetPartidasByPresupuestoQueryHandler;
use App\Application\Presupuestos\Commands\CreatePresupuestoCommand;
use App\Application\Presupuestos\Handlers\CreatePresupuestoHandler;
use App\Application\Presupuestos\Queries\GetAllPresupuestosQuery;
use App\Application\Presupuestos\QueryHandlers\GetAllPresupuestosQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\EjecucionPresupuestaria\StoreEjecucionPresupuestariaRequest;
use App\Http\Requests\PartidasPresupuestarias\StorePartidaPresupuestariaRequest;
use App\Http\Requests\Presupuestos\StorePresupuestoRequest;
use Illuminate\Http\JsonResponse;

class PresupuestoController extends Controller
{
    public function __construct(
        private readonly GetAllPresupuestosQueryHandler $getAllHandler,
        private readonly CreatePresupuestoHandler $createHandler,
        private readonly GetPartidasByPresupuestoQueryHandler $getPartidasHandler,
        private readonly CreatePartidaPresupuestariaHandler $createPartidaHandler,
        private readonly GetEjecucionByPresupuestoQueryHandler $getEjecucionHandler,
        private readonly CreateEjecucionPresupuestariaHandler $createEjecucionHandler,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->getAllHandler->handle(new GetAllPresupuestosQuery));
    }

    public function store(StorePresupuestoRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreatePresupuestoCommand(
            secretaria_id: (int) $request->secretaria_id,
            gestion: (int) $request->gestion,
            monto_aprobado: (float) $request->monto_aprobado,
            monto_modificado: $request->monto_modificado ? (float) $request->monto_modificado : null,
            estado: $request->get('estado', 'aprobado'),
            documento_url: $request->documento_url,
            fecha_aprobacion: $request->fecha_aprobacion,
            aprobado_por: auth()->id(),
        ));

        return response()->json($dto, 201);
    }

    public function indexPartidas(int $presupuestoId): JsonResponse
    {
        return response()->json($this->getPartidasHandler->handle(new GetPartidasByPresupuestoQuery($presupuestoId)));
    }

    public function storePartida(StorePartidaPresupuestariaRequest $request): JsonResponse
    {
        $dto = $this->createPartidaHandler->handle(new CreatePartidaPresupuestariaCommand(
            presupuesto_id: (int) $request->presupuesto_id,
            codigo_partida: $request->codigo_partida,
            monto_asignado: (float) $request->monto_asignado,
            descripcion: $request->descripcion,
            categoria: $request->categoria,
        ));

        return response()->json($dto, 201);
    }

    public function indexEjecuciones(int $presupuestoId): JsonResponse
    {
        return response()->json($this->getEjecucionHandler->handle(new GetEjecucionByPresupuestoQuery($presupuestoId)));
    }

    public function storeEjecucion(StoreEjecucionPresupuestariaRequest $request): JsonResponse
    {
        $dto = $this->createEjecucionHandler->handle(new CreateEjecucionPresupuestariaCommand(
            partida_id: (int) $request->partida_id,
            monto_devengado: (float) $request->monto_devengado,
            mes: (int) $request->mes,
            gestion: (int) $request->gestion,
            proyecto_id: $request->proyecto_id ? (int) $request->proyecto_id : null,
            monto_pagado: $request->monto_pagado ? (float) $request->monto_pagado : null,
            descripcion_gasto: $request->descripcion_gasto,
            fecha_registro: $request->fecha_registro,
            registrado_por: auth()->id(),
        ));

        return response()->json($dto, 201);
    }
}
