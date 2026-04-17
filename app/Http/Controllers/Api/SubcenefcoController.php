<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcenefcoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = $request->get('query', '');
        $size  = (int) $request->get('pageSize', 50);
        $page  = (int) $request->get('pageIndex', 1);

        $q = DB::table('subcenefcos');
        if ($query) { $q->where('nombre', 'like', "%{$query}%"); }
        if (!$request->boolean('conInactivos', false)) { $q->where('activa', true); }

        $total = $q->count();
        $data  = $q->orderBy('nombre')->offset(($page - 1) * $size)->limit($size)->get();

        return response()->json(['data' => $data, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $row = DB::table('subcenefcos')->where('id', $id)->first();
        if (!$row) { abort(404, 'Subcenefco no encontrado'); }
        return response()->json($row);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre'               => ['required', 'string', 'max:200'],
            'zona_cobertura'       => ['nullable', 'string'],
            'direccion_fisica'     => ['nullable', 'string', 'max:200'],
            'telefono'             => ['nullable', 'string', 'max:50'],
            'email'                => ['nullable', 'email', 'max:200'],
            'imagen_url'           => ['nullable', 'string', 'max:200'],
            'latitud'              => ['nullable', 'numeric'],
            'longitud'             => ['nullable', 'numeric'],
            'tramites_disponibles' => ['nullable', 'string'],
            'activa'               => ['nullable', 'boolean'],
            'slug'                 => ['nullable', 'string', 'max:200'],
        ]);
        $data['activa']     = $request->boolean('activa', true);
        $data['slug']       = $data['slug'] ?? Str::slug($data['nombre']);
        $data['created_at'] = now();

        $id = DB::table('subcenefcos')->insertGetId($data);
        return response()->json(DB::table('subcenefcos')->where('id', $id)->first(), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $row = DB::table('subcenefcos')->where('id', $id)->first();
        if (!$row) { abort(404, 'Subcenefco no encontrado'); }

        $data = $request->validate([
            'nombre'               => ['sometimes', 'required', 'string', 'max:200'],
            'zona_cobertura'       => ['nullable', 'string'],
            'direccion_fisica'     => ['nullable', 'string', 'max:200'],
            'telefono'             => ['nullable', 'string', 'max:50'],
            'email'                => ['nullable', 'email', 'max:200'],
            'imagen_url'           => ['nullable', 'string', 'max:200'],
            'latitud'              => ['nullable', 'numeric'],
            'longitud'             => ['nullable', 'numeric'],
            'tramites_disponibles' => ['nullable', 'string'],
            'activa'               => ['nullable', 'boolean'],
        ]);
        if (isset($data['nombre'])) {
            $data['slug'] = Str::slug($data['nombre']);
        }
        DB::table('subcenefcos')->where('id', $id)->update($data);
        return response()->json(DB::table('subcenefcos')->where('id', $id)->first());
    }

    public function destroy(int $id): JsonResponse
    {
        DB::table('subcenefcos')->where('id', $id)->update(['activa' => false]);
        return response()->json(null, 204);
    }
}