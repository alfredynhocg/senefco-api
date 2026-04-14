<?php

namespace App\Http\Controllers\Api\Reportes;

use App\Application\Reportes\Queries\GetVentasPorPeriodoQuery;
use App\Application\Reportes\QueryHandlers\GetVentasPorPeriodoQueryHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function __construct(
        private readonly GetVentasPorPeriodoQueryHandler $ventasPorPeriodoHandler,
    ) {}

    public function ventasPorPeriodo(Request $request): JsonResponse
    {
        $data = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'usuario_id' => 'nullable|exists:users,id',
        ]);

        $resultado = $this->ventasPorPeriodoHandler->handle(
            new GetVentasPorPeriodoQuery(
                fechaInicio: $data['fecha_inicio'],
                fechaFin: $data['fecha_fin'],
                usuarioId: $data['usuario_id'] ?? null,
            )
        );

        return response()->json($resultado);
    }
}
