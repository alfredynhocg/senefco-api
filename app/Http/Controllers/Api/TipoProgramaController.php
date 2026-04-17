<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoProgramaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = DB::table('t_tipoprograma')
            ->where('estado', 1)
            ->select('id_tipoprograma', 'id_us_reg', 'nombre_tipoprograma', 'estado');

        if ($search = $request->get('query')) {
            $q->where('nombre_tipoprograma', 'like', "%{$search}%");
        }

        $items = $q->orderBy('nombre_tipoprograma', 'asc')->get();

        return response()->json(['data' => $items, 'total' => $items->count()]);
    }
}
