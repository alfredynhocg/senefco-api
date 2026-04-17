<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\TramiteSolicitudes\Models\TramiteEtapa;
use App\Infrastructure\TramiteSolicitudes\Models\TramiteSolicitud;
use App\Infrastructure\TramiteSolicitudes\Models\TramiteSolicitudHistorial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TramiteSolicitudController extends Controller
{
    // ── Admin: etapas CRUD ─────────────────────────────────────────────────────

    public function etapasPorTramite(int $tramiteId): JsonResponse
    {
        $etapas = TramiteEtapa::where('tramite_id', $tramiteId)
            ->orderBy('orden')
            ->get()
            ->map(fn ($e) => $this->formatEtapa($e))
            ->all();

        return response()->json(['data' => $etapas]);
    }

    public function storeEtapa(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'tramite_id' => 'required|integer|exists:tramites_catalogo,id',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'instruccion_ciudadano' => 'nullable|string',
            'orden' => 'required|integer|min:1',
            'es_final' => 'boolean',
        ]);

        $etapa = TramiteEtapa::create($validated);

        return response()->json($this->formatEtapa($etapa), 201);
    }

    public function updateEtapa(Request $request, int $id): JsonResponse
    {
        $etapa = TramiteEtapa::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:150',
            'descripcion' => 'nullable|string',
            'instruccion_ciudadano' => 'nullable|string',
            'orden' => 'sometimes|integer|min:1',
            'es_final' => 'boolean',
        ]);

        $etapa->update($validated);

        return response()->json($this->formatEtapa($etapa->fresh()));
    }

    public function destroyEtapa(int $id): JsonResponse
    {
        TramiteEtapa::findOrFail($id)->delete();

        return response()->json(null, 204);
    }

    // ── Admin ─────────────────────────────────────────────────────────────────

    public function index(Request $request): JsonResponse
    {
        $q = TramiteSolicitud::query()->with('tramite');

        if ($search = $request->get('query')) {
            $q->where(function ($sub) use ($search) {
                $sub->where('numero_seguimiento', 'like', "%{$search}%")
                    ->orWhere('nombre_ciudadano', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($estado = $request->get('estado')) {
            $q->where('estado', $estado);
        }

        if ($tramiteId = $request->get('tramite_id')) {
            $q->where('tramite_id', $tramiteId);
        }

        $pageSize = (int) $request->get('pageSize', 20);
        $pageIndex = (int) $request->get('pageIndex', 1);

        $paginated = $q->orderByDesc('created_at')
            ->paginate($pageSize, ['*'], 'page', $pageIndex);

        $data = collect($paginated->items())->map(fn ($s) => $this->formatSolicitud($s))->all();

        return response()->json([
            'data' => $data,
            'total' => $paginated->total(),
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $solicitud = TramiteSolicitud::with(['tramite', 'historial'])->findOrFail($id);

        $etapas = TramiteEtapa::where('tramite_id', $solicitud->tramite_id)
            ->orderBy('orden')
            ->get()
            ->map(fn ($e) => [
                'orden' => $e->orden,
                'nombre' => $e->nombre,
                'descripcion' => $e->descripcion,
                'instruccion_ciudadano' => $e->instruccion_ciudadano,
                'es_final' => $e->es_final,
                'completada' => $e->orden < $solicitud->etapa_actual,
                'activa' => $e->orden === $solicitud->etapa_actual,
            ])->all();

        $historial = $solicitud->historial->map(fn ($h) => [
            'etapa_orden' => $h->etapa_orden,
            'etapa_nombre' => $h->etapa_nombre,
            'observacion' => $h->observacion,
            'fecha' => $h->created_at?->toIso8601String(),
        ])->all();

        return response()->json(array_merge(
            $this->formatSolicitud($solicitud),
            ['etapas' => $etapas, 'historial' => $historial]
        ));
    }

    public function avanzar(Request $request, int $id): JsonResponse
    {
        $solicitud = TramiteSolicitud::with('tramite')->findOrFail($id);

        if ($solicitud->estado !== 'en_proceso') {
            return response()->json(['message' => 'La solicitud no está en proceso.'], 422);
        }

        $totalEtapas = TramiteEtapa::where('tramite_id', $solicitud->tramite_id)->count();

        if ($solicitud->etapa_actual >= $totalEtapas) {
            // Está en la última etapa → marcar como completado
            $solicitud->update(['estado' => 'completado']);
        } else {
            $solicitud->increment('etapa_actual');
        }

        $etapaActual = TramiteEtapa::where('tramite_id', $solicitud->tramite_id)
            ->where('orden', $solicitud->fresh()->etapa_actual)
            ->first();

        TramiteSolicitudHistorial::create([
            'solicitud_id' => $solicitud->id,
            'etapa_orden' => $solicitud->fresh()->etapa_actual,
            'etapa_nombre' => $etapaActual?->nombre ?? 'Completado',
            'observacion' => $request->get('observacion'),
        ]);

        return response()->json([
            'message' => 'Etapa avanzada correctamente.',
            'etapa_actual' => $solicitud->fresh()->etapa_actual,
            'estado' => $solicitud->fresh()->estado,
        ]);
    }

    public function cancelar(Request $request, int $id): JsonResponse
    {
        $solicitud = TramiteSolicitud::findOrFail($id);

        $solicitud->update([
            'estado' => 'cancelado',
            'observaciones' => $request->get('motivo'),
        ]);

        TramiteSolicitudHistorial::create([
            'solicitud_id' => $solicitud->id,
            'etapa_orden' => $solicitud->etapa_actual,
            'etapa_nombre' => 'Cancelado',
            'observacion' => $request->get('motivo') ?? 'Solicitud cancelada por administrador.',
        ]);

        return response()->json(['message' => 'Solicitud cancelada.']);
    }

    // ── Portal público ─────────────────────────────────────────────────────────

    public function storeSolicitudPortal(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'tramite_id' => 'required|integer|exists:tramites_catalogo,id',
            'nombre_ciudadano' => 'required|string|max:200',
            'ci' => 'nullable|string|max:20',
            'phone' => 'required|string|max:30',
        ]);

        $tieneEtapas = TramiteEtapa::where('tramite_id', $validated['tramite_id'])->exists();
        if (! $tieneEtapas) {
            return response()->json(['message' => 'Este trámite no tiene seguimiento en línea disponible.'], 422);
        }

        $solicitud = TramiteSolicitud::create([
            'tramite_id' => $validated['tramite_id'],
            'nombre_ciudadano' => $validated['nombre_ciudadano'],
            'ci' => $validated['ci'] ?? null,
            'phone' => $validated['phone'],
            'etapa_actual' => 1,
            'estado' => 'en_proceso',
        ]);

        $primeraEtapa = TramiteEtapa::where('tramite_id', $validated['tramite_id'])
            ->orderBy('orden')
            ->first();

        if ($primeraEtapa) {
            TramiteSolicitudHistorial::create([
                'solicitud_id' => $solicitud->id,
                'etapa_orden' => $primeraEtapa->orden,
                'etapa_nombre' => $primeraEtapa->nombre,
                'observacion' => 'Solicitud registrada vía portal web.',
            ]);
        }

        $solicitud->refresh();

        return response()->json([
            'numero_seguimiento' => $solicitud->numero_seguimiento,
            'tramite_id' => $solicitud->tramite_id,
            'nombre_ciudadano' => $solicitud->nombre_ciudadano,
            'ci' => $solicitud->ci,
            'phone' => $solicitud->phone,
            'estado' => $solicitud->estado,
            'etapa_actual' => $solicitud->etapa_actual,
            'created_at' => $solicitud->created_at?->toIso8601String(),
        ], 201);
    }

    public function consultarSeguimiento(string $numero): JsonResponse
    {
        $solicitud = TramiteSolicitud::with(['tramite', 'historial'])
            ->where('numero_seguimiento', strtoupper($numero))
            ->first();

        if (! $solicitud) {
            return response()->json(['message' => 'Número de seguimiento no encontrado.'], 404);
        }

        $etapas = TramiteEtapa::where('tramite_id', $solicitud->tramite_id)
            ->orderBy('orden')
            ->get()
            ->map(fn ($e) => [
                'orden' => $e->orden,
                'nombre' => $e->nombre,
                'descripcion' => $e->descripcion,
                'es_final' => $e->es_final,
                'completada' => $e->orden < $solicitud->etapa_actual,
                'activa' => $e->orden === $solicitud->etapa_actual,
            ])->all();

        $historial = $solicitud->historial->map(fn ($h) => [
            'etapa_orden' => $h->etapa_orden,
            'etapa_nombre' => $h->etapa_nombre,
            'observacion' => $h->observacion,
            'fecha' => $h->created_at?->toIso8601String(),
        ])->all();

        return response()->json([
            'numero_seguimiento' => $solicitud->numero_seguimiento,
            'tramite' => $solicitud->tramite->nombre,
            'nombre_ciudadano' => $solicitud->nombre_ciudadano,
            'estado' => $solicitud->estado,
            'etapa_actual' => $solicitud->etapa_actual,
            'etapas' => $etapas,
            'historial' => $historial,
            'created_at' => $solicitud->created_at?->toIso8601String(),
        ]);
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    private function formatEtapa(TramiteEtapa $e): array
    {
        return [
            'id' => $e->id,
            'tramite_id' => $e->tramite_id,
            'nombre' => $e->nombre,
            'descripcion' => $e->descripcion,
            'instruccion_ciudadano' => $e->instruccion_ciudadano,
            'orden' => $e->orden,
            'es_final' => $e->es_final,
        ];
    }

    private function formatSolicitud(TramiteSolicitud $s): array
    {
        return [
            'id' => $s->id,
            'numero_seguimiento' => $s->numero_seguimiento,
            'tramite_id' => $s->tramite_id,
            'tramite_nombre' => $s->tramite?->nombre,
            'phone' => $s->phone,
            'nombre_ciudadano' => $s->nombre_ciudadano,
            'ci' => $s->ci,
            'etapa_actual' => $s->etapa_actual,
            'estado' => $s->estado,
            'observaciones' => $s->observaciones,
            'created_at' => $s->created_at?->toIso8601String(),
            'updated_at' => $s->updated_at?->toIso8601String(),
        ];
    }
}
