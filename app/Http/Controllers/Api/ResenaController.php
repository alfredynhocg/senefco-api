<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResenaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = DB::table('web_programa_resena as r')
            ->leftJoin('t_programa as p', 'r.programa_id', '=', 'p.id_programa')
            ->select('r.*', 'p.nombre_programa');

        if ($search = $request->get('query')) {
            $q->where(function ($sub) use ($search) {
                $sub->where('r.nombre', 'like', "%{$search}%")
                    ->orWhere('r.titulo_resena', 'like', "%{$search}%")
                    ->orWhere('r.resena', 'like', "%{$search}%");
            });
        }

        if ($estado = $request->get('estado')) {
            $q->where('r.estado', $estado);
        }

        if ($programa = $request->get('programa_id')) {
            $q->where('r.programa_id', $programa);
        }

        $pageSize = (int) $request->get('pageSize', 15);
        $pageIndex = (int) $request->get('pageIndex', 1);
        $offset = ($pageIndex - 1) * $pageSize;

        $total = $q->count();
        $items = (clone $q)
            ->orderBy('r.created_at', 'desc')
            ->offset($offset)
            ->limit($pageSize)
            ->get();

        return response()->json(['data' => $items, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $item = DB::table('web_programa_resena as r')
            ->leftJoin('t_programa as p', 'r.programa_id', '=', 'p.id_programa')
            ->select('r.*', 'p.nombre_programa')
            ->where('r.id', $id)
            ->first();

        if (! $item) {
            abort(404);
        }

        return response()->json($item);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (! DB::table('web_programa_resena')->where('id', $id)->exists()) {
            abort(404);
        }

        $data = $request->validate([
            'estado' => ['required', 'in:pendiente,aprobada,rechazada'],
            'verificado' => ['nullable', 'boolean'],
            'destacada' => ['nullable', 'boolean'],
            'motivo_rechazo' => ['nullable', 'string', 'max:300'],
        ]);

        $data['updated_at'] = now()->toDateTimeString();
        DB::table('web_programa_resena')->where('id', $id)->update($data);

        return response()->json(DB::table('web_programa_resena')->where('id', $id)->first());
    }

    public function destroy(int $id): JsonResponse
    {
        if (! DB::table('web_programa_resena')->where('id', $id)->delete()) {
            abort(404);
        }

        return response()->json(null, 204);
    }
}
