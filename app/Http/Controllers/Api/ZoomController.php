<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ZoomApiService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ZoomController extends Controller
{
    public function __construct(private readonly ZoomApiService $zoom) {}

    public function meetings(): JsonResponse
    {
        try {
            return response()->json(['meetings' => $this->zoom->listarReuniones()]);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al conectar con Zoom: '.$e->getMessage()], 502);
        }
    }

    public function crearReunion(Request $request): JsonResponse
    {
        $data = $request->validate([
            'tipo'        => ['required', 'in:unica,multisesion'],
            'tema'        => ['required_if:tipo,unica', 'nullable', 'string', 'max:255'],
            'curso'       => ['required_if:tipo,multisesion', 'nullable', 'string', 'max:255'],
            'fecha_inicio' => ['required', 'string'],
            'duracion_min' => ['nullable', 'integer', 'min:15', 'max:480'],
            'n_sesiones'  => ['required_if:tipo,multisesion', 'nullable', 'integer', 'min:1', 'max:52'],
            'dias_entre'  => ['nullable', 'integer', 'min:1'],
        ]);

        $duracion = (int) ($data['duracion_min'] ?? 60);

        try {
            if ($data['tipo'] === 'unica') {
                $reunion = $this->zoom->crearReunion(
                    $data['tema'],
                    $data['fecha_inicio'],
                    $duracion
                );
                return response()->json(['tipo' => 'unica', 'reunion' => $reunion], 201);
            }

            $sesiones   = [];
            $fechaDt    = Carbon::parse($data['fecha_inicio']);
            $diasEntre  = (int) ($data['dias_entre'] ?? 7);
            $nSesiones  = (int) $data['n_sesiones'];
            $nombreCurso = $data['curso'];

            for ($i = 1; $i <= $nSesiones; $i++) {
                $tema  = "{$nombreCurso} — Sesión {$i}";
                $fecha = $fechaDt->copy()->addDays($diasEntre * ($i - 1))->format('Y-m-d\TH:i:s');
                $sesiones[] = $this->zoom->crearReunion($tema, $fecha, $duracion);
            }

            return response()->json(['tipo' => 'multisesion', 'sesiones' => $sesiones], 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al crear reunión en Zoom: '.$e->getMessage()], 502);
        }
    }

    public function recordings(): JsonResponse
    {
        try {
            return response()->json(['recordings' => $this->zoom->grabaciones()]);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al obtener grabaciones: '.$e->getMessage()], 502);
        }
    }
}
