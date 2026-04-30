<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriaCampoController extends Controller
{
    private const TIPOS_VALIDOS = [
        'text', 'email', 'number', 'date', 'textarea',
        'select', 'boolean', 'file_pdf', 'file_image',
    ];

    public function index(int $categoriaId): JsonResponse
    {
        if (! DB::table('web_categoria_programa')->where('id', $categoriaId)->exists()) {
            abort(404, 'Categoría no encontrada');
        }

        $campos = DB::table('web_categoria_campo')
            ->where('categoria_id', $categoriaId)
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

        return response()->json(['data' => $campos, 'total' => $campos->count()]);
    }

    public function store(Request $request, int $categoriaId): JsonResponse
    {
        if (! DB::table('web_categoria_programa')->where('id', $categoriaId)->exists()) {
            abort(404, 'Categoría no encontrada');
        }

        $data = $request->validate([
            'nombre_campo' => ['required', 'string', 'max:80', 'regex:/^[a-z0-9_]+$/'],
            'etiqueta'     => ['required', 'string', 'max:200'],
            'tipo_campo'   => ['required', 'in:' . implode(',', self::TIPOS_VALIDOS)],
            'requerido'    => ['nullable', 'boolean'],
            'orden'        => ['nullable', 'integer'],
            'activo'       => ['nullable', 'boolean'],
            'ayuda'        => ['nullable', 'string', 'max:400'],
            'opciones'     => ['nullable', 'array'],
            'opciones.*'   => ['string', 'max:200'],
            'validacion'   => ['nullable', 'array'],
        ]);

        if (DB::table('web_categoria_campo')
            ->where('categoria_id', $categoriaId)
            ->where('nombre_campo', $data['nombre_campo'])
            ->exists()
        ) {
            return response()->json([
                'message' => 'Ya existe un campo con ese nombre en esta categoría.',
                'errors'  => ['nombre_campo' => ['El nombre de campo ya está en uso.']],
            ], 422);
        }

        $id = DB::table('web_categoria_campo')->insertGetId([
            'categoria_id' => $categoriaId,
            'nombre_campo' => $data['nombre_campo'],
            'etiqueta'     => $data['etiqueta'],
            'tipo_campo'   => $data['tipo_campo'],
            'requerido'    => $data['requerido'] ?? false,
            'orden'        => $data['orden'] ?? 0,
            'activo'       => $data['activo'] ?? true,
            'ayuda'        => $data['ayuda'] ?? null,
            'opciones'     => isset($data['opciones']) ? json_encode($data['opciones']) : null,
            'validacion'   => isset($data['validacion']) ? json_encode($data['validacion']) : null,
            'created_at'   => now()->toDateTimeString(),
            'updated_at'   => now()->toDateTimeString(),
        ]);

        return response()->json($this->findOrFail($id), 201);
    }

    public function update(Request $request, int $categoriaId, int $id): JsonResponse
    {
        $campo = DB::table('web_categoria_campo')
            ->where('id', $id)
            ->where('categoria_id', $categoriaId)
            ->first();

        if (! $campo) {
            abort(404, 'Campo no encontrado');
        }

        $data = $request->validate([
            'etiqueta'   => ['sometimes', 'required', 'string', 'max:200'],
            'tipo_campo' => ['sometimes', 'required', 'in:' . implode(',', self::TIPOS_VALIDOS)],
            'requerido'  => ['nullable', 'boolean'],
            'orden'      => ['nullable', 'integer'],
            'activo'     => ['nullable', 'boolean'],
            'ayuda'      => ['nullable', 'string', 'max:400'],
            'opciones'   => ['nullable', 'array'],
            'opciones.*' => ['string', 'max:200'],
            'validacion' => ['nullable', 'array'],
        ]);

        $update = array_filter([
            'etiqueta'   => $data['etiqueta'] ?? null,
            'tipo_campo' => $data['tipo_campo'] ?? null,
            'requerido'  => isset($data['requerido']) ? (bool) $data['requerido'] : null,
            'orden'      => $data['orden'] ?? null,
            'activo'     => isset($data['activo']) ? (bool) $data['activo'] : null,
            'ayuda'      => array_key_exists('ayuda', $data) ? $data['ayuda'] : null,
        ], fn ($v) => $v !== null);

        if (array_key_exists('opciones', $data)) {
            $update['opciones'] = $data['opciones'] !== null ? json_encode($data['opciones']) : null;
        }
        if (array_key_exists('validacion', $data)) {
            $update['validacion'] = $data['validacion'] !== null ? json_encode($data['validacion']) : null;
        }

        $update['updated_at'] = now()->toDateTimeString();

        DB::table('web_categoria_campo')->where('id', $id)->update($update);

        return response()->json($this->findOrFail($id));
    }

    public function destroy(int $categoriaId, int $id): JsonResponse
    {
        $deleted = DB::table('web_categoria_campo')
            ->where('id', $id)
            ->where('categoria_id', $categoriaId)
            ->delete();

        if (! $deleted) {
            abort(404, 'Campo no encontrado');
        }

        return response()->json(null, 204);
    }

    public function reorder(Request $request, int $categoriaId): JsonResponse
    {
        if (! DB::table('web_categoria_programa')->where('id', $categoriaId)->exists()) {
            abort(404, 'Categoría no encontrada');
        }

        $items = $request->validate([
            'items'         => ['required', 'array'],
            'items.*.id'    => ['required', 'integer'],
            'items.*.orden' => ['required', 'integer'],
        ])['items'];

        DB::transaction(function () use ($items, $categoriaId) {
            foreach ($items as $item) {
                DB::table('web_categoria_campo')
                    ->where('id', $item['id'])
                    ->where('categoria_id', $categoriaId)
                    ->update(['orden' => $item['orden'], 'updated_at' => now()->toDateTimeString()]);
            }
        });

        return response()->json(['ok' => true]);
    }

    private function findOrFail(int $id): object
    {
        $campo = DB::table('web_categoria_campo')->where('id', $id)->first();

        if (! $campo) {
            abort(404);
        }

        if (is_string($campo->opciones)) {
            $campo->opciones = json_decode($campo->opciones);
        }
        if (is_string($campo->validacion)) {
            $campo->validacion = json_decode($campo->validacion);
        }

        return $campo;
    }
}
