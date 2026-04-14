<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuItemController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $menuId = $request->get('menu_id');
        $query = $request->get('query', '');
        $size = (int) $request->get('pageSize', 50);
        $page = (int) $request->get('pageIndex', 1);

        $q = DB::table('menu_items');
        if ($menuId) {
            $q->where('menu_id', $menuId);
        }
        if ($query) {
            $q->where('etiqueta', 'like', "%{$query}%");
        }

        $total = $q->count();
        $data = $q->orderBy('orden')->orderBy('id')->offset(($page - 1) * $size)->limit($size)->get();

        return response()->json(['data' => $data, 'total' => $total]);
    }

    public function show(int $id): JsonResponse
    {
        $item = DB::table('menu_items')->find($id);
        if (! $item) {
            abort(404, 'Item no encontrado');
        }

        return response()->json($item);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'menu_id' => ['required', 'integer', 'exists:menus,id'],
            'parent_id' => ['nullable', 'integer', 'exists:menu_items,id'],
            'etiqueta' => ['required', 'string', 'max:150'],
            'url' => ['nullable', 'string', 'max:255'],
            'orden' => ['nullable', 'integer'],
            'icono' => ['nullable', 'string', 'max:50'],
            'activo' => ['nullable', 'boolean'],
            'abrir_nueva_ventana' => ['nullable', 'boolean'],
        ]);
        $data['activo'] = $request->boolean('activo', true);
        $data['abrir_nueva_ventana'] = $request->boolean('abrir_nueva_ventana', false);
        $data['orden'] = $request->integer('orden', 0);

        $id = DB::table('menu_items')->insertGetId($data);
        $item = DB::table('menu_items')->find($id);

        return response()->json($item, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = DB::table('menu_items')->find($id);
        if (! $item) {
            abort(404, 'Item no encontrado');
        }

        $data = $request->validate([
            'menu_id' => ['required', 'integer', 'exists:menus,id'],
            'parent_id' => ['nullable', 'integer', 'exists:menu_items,id'],
            'etiqueta' => ['required', 'string', 'max:150'],
            'url' => ['nullable', 'string', 'max:255'],
            'orden' => ['nullable', 'integer'],
            'icono' => ['nullable', 'string', 'max:50'],
            'activo' => ['nullable', 'boolean'],
            'abrir_nueva_ventana' => ['nullable', 'boolean'],
        ]);
        $data['activo'] = $request->boolean('activo', true);
        $data['abrir_nueva_ventana'] = $request->boolean('abrir_nueva_ventana', false);
        $data['orden'] = $request->integer('orden', 0);

        DB::table('menu_items')->where('id', $id)->update($data);

        return response()->json(DB::table('menu_items')->find($id));
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = DB::table('menu_items')->where('id', $id)->delete();
        if (! $deleted) {
            abort(404, 'Item no encontrado');
        }

        return response()->json(null, 204);
    }
}
