<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchivoReto;
use App\Models\Categoria;
use App\Models\Competencia;
use App\Models\EstadoReto;
use App\Models\NivelReto;
use App\Models\Pista;
use App\Models\Reto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RetoController extends Controller
{
    public function index()
    {
        $retos = Reto::with(['categoria', 'nivel', 'estadoReto', 'competencia', 'archivo', 'pistas'])->get();
        $categorias = Categoria::all();
        $niveles = NivelReto::all();
        $competencias = Competencia::all();
        $estados = EstadoReto::all();

        return view('admin.a-retos', compact('retos', 'categorias', 'niveles', 'competencias', 'estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomreto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'flag' => 'required|string|max:255',
            'puntos' => 'required|integer|min:0',
            'fk_categoria' => 'required|exists:categorias,idcategoria',
            'fk_nivel' => 'required|exists:niveles_reto,idnivel_reto',
            'fk_competencia' => 'required|exists:competencias,idcompetencia',
            'fk_estado_reto' => 'required|exists:estados_reto,idestado_reto',
            'archivo' => 'nullable|file|max:10240',  // 10MB max
            'pistas' => 'nullable|array',
            'pistas.*.contenido' => 'required_with:pistas|string',
            'pistas.*.valor' => 'required_with:pistas|integer|min:0'
        ]);

        DB::beginTransaction();

        try {
            // Crear el reto
            $reto = Reto::create([
                'nomreto' => $request->nomreto,
                'descripcion' => $request->descripcion,
                'flag' => $request->flag,
                'puntos' => $request->puntos,
                'fk_categoria' => $request->fk_categoria,
                'fk_nivel' => $request->fk_nivel,
                'fk_competencia' => $request->fk_competencia,
                'fk_estado_reto' => $request->fk_estado_reto,
            ]);

            // Manejar archivo si existe
            if ($request->hasFile('archivo')) {
                $archivo = $request->file('archivo');
                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                $rutaArchivo = $archivo->storeAs('retos', $nombreArchivo, 'public');

                ArchivoReto::create([
                    'nombre' => $nombreArchivo,
                    'url' => 'storage/' . $rutaArchivo,  // Usar url en lugar de ruta
                    'tipo' => $archivo->getClientMimeType(),
                    'fk_retos' => $reto->idretos  // Usar fk_retos
                ]);
            }

            // Manejar pistas si existen
            if ($request->has('pistas') && is_array($request->pistas)) {
                foreach ($request->pistas as $pistaData) {
                    if (!empty($pistaData['contenido'])) {
                        $pista = Pista::create([
                            'contenido' => $pistaData['contenido'],
                            'valor' => $pistaData['valor'] ?? 0
                        ]);
                        $reto->pistas()->attach($pista->idpistas);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Reto creado correctamente',
                'reto' => $reto
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el reto: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $reto = Reto::with(['categoria', 'nivel', 'estadoReto', 'competencia', 'archivo', 'pistas'])
                ->findOrFail($id);

            return response()->json($reto);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Reto no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomreto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'flag' => 'required|string|max:255',
            'puntos' => 'required|integer|min:0',
            'fk_categoria' => 'required|exists:categorias,idcategoria',
            'fk_nivel' => 'required|exists:niveles_reto,idnivel_reto',
            'fk_competencia' => 'required|exists:competencias,idcompetencia',
            'fk_estado_reto' => 'required|exists:estados_reto,idestado_reto',
            'archivo' => 'nullable|file|max:10240',
            'pistas' => 'nullable|array',
            'pistas.*.contenido' => 'required_with:pistas|string',
            'pistas.*.valor' => 'required_with:pistas|integer|min:0'
        ]);

        DB::beginTransaction();

        try {
            $reto = Reto::findOrFail($id);

            // Actualizar datos básicos del reto
            $reto->update([
                'nomreto' => $request->nomreto,
                'descripcion' => $request->descripcion,
                'flag' => $request->flag,
                'puntos' => $request->puntos,
                'fk_categoria' => $request->fk_categoria,
                'fk_nivel' => $request->fk_nivel,
                'fk_competencia' => $request->fk_competencia,
                'fk_estado_reto' => $request->fk_estado_reto,
            ]);

            // Manejar archivo si se proporciona uno nuevo
            if ($request->hasFile('archivo')) {
                // Eliminar archivo anterior si existe
                if ($reto->archivo) {
                    // Extraer la ruta del storage de la URL
                    $rutaArchivo = str_replace('storage/', '', $reto->archivo->url);
                    Storage::disk('public')->delete($rutaArchivo);
                    $reto->archivo->delete();
                }

                $archivo = $request->file('archivo');
                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                $rutaArchivo = $archivo->storeAs('retos', $nombreArchivo, 'public');

                ArchivoReto::create([
                    'nombre' => $nombreArchivo,
                    'url' => 'storage/' . $rutaArchivo,
                    'tipo' => $archivo->getClientMimeType(),
                    'fk_retos' => $reto->idretos
                ]);
            }

            // Manejar pistas SOLO si se enviaron nuevas pistas
            if ($request->has('pistas') && is_array($request->pistas)) {
                // Solo agregar nuevas pistas, NO eliminar las existentes
                foreach ($request->pistas as $pistaData) {
                    if (!empty($pistaData['contenido'])) {
                        // Verificar si ya existe una pista con el mismo contenido para este reto
                        $pistaExistente = $reto->pistas()->where('contenido', $pistaData['contenido'])->first();

                        if (!$pistaExistente) {
                            $pista = Pista::create([
                                'contenido' => $pistaData['contenido'],
                                'valor' => $pistaData['valor'] ?? 0
                            ]);
                            $reto->pistas()->attach($pista->idpistas);
                        } else {
                            // Si existe, actualizar solo el valor
                            $pistaExistente->update(['valor' => $pistaData['valor'] ?? 0]);
                        }
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Reto actualizado correctamente',
                'reto' => $reto
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el reto: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $reto = Reto::findOrFail($id);

            // Verificar si el reto tiene dependencias en hitlog_personas
            $tieneRegistrosUso = DB::table('hitlog_personas')
                ->join('retos_has_pistas', 'hitlog_personas.fk_idretos_has_pistas', '=', 'retos_has_pistas.idretos_has_pistas')
                ->where('retos_has_pistas.fk_idretos', $id)
                ->exists();

            if ($tieneRegistrosUso) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar el reto porque tiene registros de participantes relacionados.'
                ], 400);
            }

            // Eliminar archivo asociado si existe
            if ($reto->archivo) {
                $rutaArchivo = str_replace('storage/', '', $reto->archivo->url);
                Storage::disk('public')->delete($rutaArchivo);
                $reto->archivo->delete();
            }

            // Eliminar pistas asociadas (solo las que no tienen dependencias)
            foreach ($reto->pistas as $pista) {
                // Verificar dependencias específicas de cada pista
                $pistaTieneDependencias = DB::table('hitlog_personas')
                    ->join('retos_has_pistas', 'hitlog_personas.fk_idretos_has_pistas', '=', 'retos_has_pistas.idretos_has_pistas')
                    ->where('retos_has_pistas.fk_idretos', $id)
                    ->where('retos_has_pistas.fk_idpistas', $pista->idpistas)
                    ->exists();

                if (!$pistaTieneDependencias) {
                    $reto->pistas()->detach($pista->idpistas);
                    $pista->delete();
                }
            }

            // Eliminar el reto
            $reto->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Reto eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el reto: Existen registros de uso relacionados o un error inesperado'
            ], 500);
        }
    }

    public function eliminarPista($retoId, $pistaId)
    {
        DB::beginTransaction();

        try {
            $reto = Reto::findOrFail($retoId);
            $pista = Pista::findOrFail($pistaId);

            // Verificar si la pista tiene dependencias
            $tieneDependencias = DB::table('hitlog_personas')
                ->join('retos_has_pistas', 'hitlog_personas.fk_idretos_has_pistas', '=', 'retos_has_pistas.idretos_has_pistas')
                ->where('retos_has_pistas.fk_idretos', $retoId)
                ->where('retos_has_pistas.fk_idpistas', $pistaId)
                ->exists();

            if ($tieneDependencias) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar la pista porque tiene registros de uso relacionados.'
                ], 400);
            }

            // Eliminar la relación y la pista
            $reto->pistas()->detach($pistaId);
            $pista->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pista eliminada correctamente'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la pista: Existen registros de uso relacionados o un error inesperado: '
            ], 500);
        }
    }
}
