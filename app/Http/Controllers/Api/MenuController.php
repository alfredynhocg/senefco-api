<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = $request->get('query', '');
        $size = (int) $request->get('pageSize', 20);
        $page = (int) $request->get('pageIndex', 1);

        $q = DB::table('menus');
        if ($query) {
            $q->where('nombre', 'like', "%{$query}%");
        }

        $total = $q->count();
        $data = $q->orderBy('id')->offset(($page - 1) * $size)->limit($size)->get();

        return response()->json(['data' => $data, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $menu = DB::table('menus')->find($id);
        if (! $menu) {
            abort(404, 'Menú no encontrado');
        }

        return response()->json($menu);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:80', 'unique:menus,nombre'],
            'descripcion' => ['nullable', 'string', 'max:100'],
            'activo' => ['nullable', 'boolean'],
        ]);
        $data['activo'] = $request->boolean('activo', true);

        $id = DB::table('menus')->insertGetId($data);
        $menu = DB::table('menus')->find($id);

        return response()->json($menu, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $menu = DB::table('menus')->find($id);
        if (! $menu) {
            abort(404, 'Menú no encontrado');
        }

        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:80', "unique:menus,nombre,{$id}"],
            'descripcion' => ['nullable', 'string', 'max:100'],
            'activo' => ['nullable', 'boolean'],
        ]);
        $data['activo'] = $request->boolean('activo', true);

        DB::table('menus')->where('id', $id)->update($data);

        return response()->json(DB::table('menus')->find($id));
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = DB::table('menus')->where('id', $id)->delete();
        if (! $deleted) {
            abort(404, 'Menú no encontrado');
        }

        return response()->json(null, 204);
    }

    public function itemsByNombre(string $nombre): JsonResponse
    {
        $menu = DB::table('menus')->where('nombre', $nombre)->where('activo', true)->first();
        if (! $menu) {
            abort(404, 'Menú no encontrado');
        }

        $items = DB::table('menu_items')
            ->where('menu_id', $menu->id)
            ->where('activo', true)
            ->orderBy('orden')
            ->get();

        return response()->json(['data' => $items, 'total' => $items->count()]);
    }
}
