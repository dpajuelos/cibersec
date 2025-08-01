<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Exception;

class CategoriaController extends Controller
{
    /**
     * Mostrar lista de categorías
     */
    public function index(Request $request): View
    {
        $query = DB::table('categorias');

        // Búsqueda solo por nombre
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('nomcategoria', 'LIKE', "%{$searchTerm}%");
        }

        // Obtener categorías con conteo de retos
        $categorias = $query
            ->leftJoin('retos', 'categorias.idcategoria', '=', 'retos.fk_categoria')
            ->select(
                'categorias.idcategoria',
                'categorias.nomcategoria',
                DB::raw('COUNT(retos.idretos) as retos_count')
            )
            ->groupBy('categorias.idcategoria', 'categorias.nomcategoria')
            ->orderBy('categorias.idcategoria', 'desc')
            ->paginate(10);

        // Total de retos
        $totalRetos = DB::table('retos')->count();

        return view('admin.a-categoria', compact('categorias', 'totalRetos'));
    }

    /**
     * Crear nueva categoría
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'nomcategoria' => 'required|string|max:100|unique:categorias,nomcategoria',
            ], [
                'nomcategoria.required' => 'El nombre de la categoría es obligatorio',
                'nomcategoria.unique' => 'Ya existe una categoría con ese nombre',
                'nomcategoria.max' => 'El nombre no puede exceder 100 caracteres'
            ]);

            $categoriaId = DB::table('categorias')->insertGetId([
                'nomcategoria' => $validated['nomcategoria']
            ]);

            // Log de actividad
            Log::info('Categoría creada', [
                'categoria_id' => $categoriaId,
                'nombre' => $validated['nomcategoria'],
                'admin_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Categoría creada exitosamente',
                'categoria' => $categoriaId
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Error al crear categoría: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Mostrar categoría específica
     */
    public function show(int $id): JsonResponse
    {
        try {
            $categoria = DB::table('categorias')
                ->leftJoin('retos', 'categorias.idcategoria', '=', 'retos.fk_categoria')
                ->select(
                    'categorias.idcategoria',
                    'categorias.nomcategoria',
                    DB::raw('COUNT(retos.idretos) as retos_count')
                )
                ->where('categorias.idcategoria', $id)
                ->groupBy('categorias.idcategoria', 'categorias.nomcategoria')
                ->first();

            if (!$categoria) {
                return response()->json([
                    'success' => false,
                    'message' => 'Categoría no encontrada'
                ], 404);
            }

            return response()->json($categoria);
        } catch (Exception $e) {
            Log::error('Error al obtener categoría: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Actualizar categoría
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            // Verificar que la categoría existe
            $categoriaExistente = DB::table('categorias')->where('idcategoria', $id)->first();
            if (!$categoriaExistente) {
                return response()->json([
                    'success' => false,
                    'message' => 'Categoría no encontrada'
                ], 404);
            }

            $validated = $request->validate([
                'nomcategoria' => 'required|string|max:100|unique:categorias,nomcategoria,' . $id . ',idcategoria',
            ], [
                'nomcategoria.required' => 'El nombre de la categoría es obligatorio',
                'nomcategoria.unique' => 'Ya existe una categoría con ese nombre',
                'nomcategoria.max' => 'El nombre no puede exceder 100 caracteres'
            ]);

            DB::table('categorias')
                ->where('idcategoria', $id)
                ->update([
                    'nomcategoria' => $validated['nomcategoria']
                ]);

            // Log de actividad
            Log::info('Categoría actualizada', [
                'categoria_id' => $id,
                'nombre' => $validated['nomcategoria'],
                'admin_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Categoría actualizada exitosamente'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Error al actualizar categoría: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Eliminar categoría
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            // Verificar que la categoría existe
            $categoria = DB::table('categorias')->where('idcategoria', $id)->first();
            if (!$categoria) {
                return response()->json([
                    'success' => false,
                    'message' => 'Categoría no encontrada'
                ], 404);
            }

            // Verificar si tiene retos asociados
            $retosAsociados = DB::table('retos')->where('fk_categoria', $id)->count();

            if ($retosAsociados > 0) {
                return response()->json([
                    'success' => false,
                    'message' => "No se puede eliminar la categoría porque tiene {$retosAsociados} retos asociados."
                ], 400);
            }

            // Eliminar la categoría
            DB::table('categorias')->where('idcategoria', $id)->delete();

            // Log de actividad
            Log::info('Categoría eliminada', [
                'categoria_id' => $id,
                'nombre' => $categoria->nomcategoria,
                'admin_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Categoría eliminada exitosamente'
            ]);
        } catch (Exception $e) {
            Log::error('Error al eliminar categoría: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Obtener estadísticas de categorías
     */
    public function estadisticas(): JsonResponse
    {
        try {
            $stats = [
                'total' => DB::table('categorias')->count(),
                'con_retos' => DB::table('categorias')
                    ->join('retos', 'categorias.idcategoria', '=', 'retos.fk_categoria')
                    ->distinct('categorias.idcategoria')
                    ->count(),
                'sin_retos' => DB::table('categorias')
                    ->leftJoin('retos', 'categorias.idcategoria', '=', 'retos.fk_categoria')
                    ->whereNull('retos.fk_categoria')
                    ->count(),
                'total_retos' => DB::table('retos')->count()
            ];

            return response()->json($stats);
        } catch (Exception $e) {
            Log::error('Error al obtener estadísticas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Búsqueda AJAX de categorías
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $query = DB::table('categorias');

            // Búsqueda solo por nombre
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
                $query->where('nomcategoria', 'LIKE', "%{$searchTerm}%");
            }

            // Obtener categorías con conteo de retos
            $categorias = $query
                ->leftJoin('retos', 'categorias.idcategoria', '=', 'retos.fk_categoria')
                ->select(
                    'categorias.idcategoria',
                    'categorias.nomcategoria',
                    DB::raw('COUNT(retos.idretos) as retos_count')
                )
                ->groupBy('categorias.idcategoria', 'categorias.nomcategoria')
                ->orderBy('categorias.idcategoria', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'categorias' => $categorias
            ]);
        } catch (Exception $e) {
            Log::error('Error en búsqueda de categorías: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor'
            ], 500);
        }
    }
}
