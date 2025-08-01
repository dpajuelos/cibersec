<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competencia;
use App\Models\EstadoCompetencia;
use App\Models\TipoCompetencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompetenciaController extends Controller
{
    /**
     * Mostrar la lista de competencias
     */
    public function index(Request $request)
    {
        $query = Competencia::with(['estado', 'tipo'])->withCount('retos');

        // Aplicar filtros
        if ($request->filled('search')) {
            $query->where('nomcompe', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('estado')) {
            $query->where('fk_estado_compe', $request->estado);
        }

        if ($request->filled('tipo')) {
            $query->where('fk_tipo_compe', $request->tipo);
        }

        // Ordenar por fecha de inicio descendente
        $query->orderBy('fec_inicio', 'desc');

        $competencias = $query->paginate(10);

        // Obtener tipos y estados para filtros
        $tiposCompetencia = TipoCompetencia::all();
        $estadosCompetencia = EstadoCompetencia::all();

        return view('admin.a-competencias', compact(
            'competencias',
            'tiposCompetencia',
            'estadosCompetencia'
        ));
    }

    /**
     * Mostrar el formulario para crear una nueva competencia
     */
    public function create()
    {
        $tiposCompetencia = TipoCompetencia::all();
        $estadosCompetencia = EstadoCompetencia::all();

        return response()->json([
            'html' => view('admin.components.competencia-modal', compact('tiposCompetencia', 'estadosCompetencia'))->render()
        ]);
    }

    /**
     * Almacenar una nueva competencia
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nomcompe' => 'required|string|max:255|unique:competencias,nomcompe',
                'descripcion' => 'required|string',
                'fec_inicio' => 'required|date|after:now',
                'fec_final' => 'required|date|after:fec_inicio',
                'fk_estado_compe' => 'required|exists:estados_compe,idestado_compe',
                'fk_tipo_compe' => 'required|exists:tipos_compe,idtipo_compe'
            ], [
                'nomcompe.unique' => 'Ya existe una competencia con este nombre.',
                'fec_inicio.after' => 'La fecha de inicio debe ser posterior a la fecha actual.',
                'fec_final.after' => 'La fecha final debe ser posterior a la fecha de inicio.'
            ]);

            // Validar que no haya conflictos de fechas
            $this->validateDateConflicts($request->fec_inicio, $request->fec_final);

            // Validar que no haya más de una competencia activa
            $this->validateActiveCompetition($request->fk_estado_compe);

            $competencia = Competencia::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Competencia creada exitosamente',
                'competencia' => $competencia->load(['estado', 'tipo'])
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Mostrar una competencia específica
     */
    public function show(Competencia $competencia)
    {
        $competencia->load(['estado', 'tipo', 'retos.categoria']);

        return response()->json([
            'success' => true,
            'competencia' => $competencia
        ]);
    }

    /**
     * Mostrar el formulario para editar una competencia
     */
    public function edit(Competencia $competencia)
    {
        $tiposCompetencia = TipoCompetencia::all();
        $estadosCompetencia = EstadoCompetencia::all();

        return response()->json([
            'html' => view('admin.components.competencia-modal', compact('competencia', 'tiposCompetencia', 'estadosCompetencia'))->render()
        ]);
    }

    /**
     * Actualizar una competencia
     */
    public function update(Request $request, Competencia $competencia)
    {
        try {
            $request->validate([
                'nomcompe' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('competencias', 'nomcompe')->ignore($competencia->idcompetencia, 'idcompetencia')
                ],
                'descripcion' => 'required|string',
                'fec_inicio' => 'required|date',
                'fec_final' => 'required|date|after:fec_inicio',
                'fk_estado_compe' => 'required|exists:estados_compe,idestado_compe',
                'fk_tipo_compe' => 'required|exists:tipos_compe,idtipo_compe'
            ], [
                'nomcompe.unique' => 'Ya existe una competencia con este nombre.',
                'fec_final.after' => 'La fecha final debe ser posterior a la fecha de inicio.'
            ]);

            // Solo validar fechas si han cambiado
            if ($competencia->fec_inicio != $request->fec_inicio || $competencia->fec_final != $request->fec_final) {
                $this->validateDateConflicts($request->fec_inicio, $request->fec_final, $competencia->idcompetencia);
            }

            // Solo validar estado activo si ha cambiado
            if ($competencia->fk_estado_compe != $request->fk_estado_compe) {
                $this->validateActiveCompetition($request->fk_estado_compe, $competencia->idcompetencia);
            }

            $competencia->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Competencia actualizada exitosamente',
                'competencia' => $competencia->load(['estado', 'tipo'])
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Eliminar una competencia
     */
    public function destroy(Competencia $competencia)
    {
        try {
            // Verificar que no tenga retos asociados
            if ($competencia->retos()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar la competencia porque tiene retos asociados'
                ], 400);
            }

            // No permitir eliminar competencias activas
            if ($competencia->estado->estadocompe === 'Activa') {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar una competencia activa'
                ], 400);
            }

            $competencia->delete();

            return response()->json([
                'success' => true,
                'message' => 'Competencia eliminada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la competencia: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Activar una competencia (cambiar estado a activa)
     */
    public function activate(Competencia $competencia)
    {
        try {
            // Obtener el ID del estado "Activa"
            $estadoActivo = EstadoCompetencia::where('estadocompe', 'Activa')->first();

            if (!$estadoActivo) {
                throw new \Exception('Estado "Activa" no encontrado en la base de datos');
            }

            // Validar que no haya otra competencia activa
            $this->validateActiveCompetition($estadoActivo->idestado_compe, $competencia->idcompetencia);

            // Validar que la fecha de inicio no haya pasado mucho tiempo
            $fechaInicio = Carbon::parse($competencia->fec_inicio);
            $ahora = Carbon::now();

            if ($fechaInicio->isPast() && $fechaInicio->diffInDays($ahora) > 1) {
                throw new \Exception('No se puede activar una competencia cuya fecha de inicio ya pasó hace más de 1 día');
            }

            $competencia->update(['fk_estado_compe' => $estadoActivo->idestado_compe]);

            return response()->json([
                'success' => true,
                'message' => 'Competencia activada exitosamente',
                'competencia' => $competencia->load(['estado', 'tipo'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Finalizar una competencia
     */
    public function finalize(Competencia $competencia)
    {
        try {
            // Obtener el ID del estado "Finalizada"
            $estadoFinalizado = EstadoCompetencia::where('estadocompe', 'Finalizada')->first();

            if (!$estadoFinalizado) {
                throw new \Exception('Estado "Finalizada" no encontrado en la base de datos');
            }

            // Solo se puede finalizar si está activa
            if ($competencia->estado->estadocompe !== 'Activa') {
                throw new \Exception('Solo se pueden finalizar competencias activas');
            }

            $competencia->update(['fk_estado_compe' => $estadoFinalizado->idestado_compe]);

            return response()->json([
                'success' => true,
                'message' => 'Competencia finalizada exitosamente',
                'competencia' => $competencia->load(['estado', 'tipo'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Validar conflictos de fechas
     */
    private function validateDateConflicts($fechaInicio, $fechaFinal, $excludeId = null)
    {
        $query = Competencia::where(function ($q) use ($fechaInicio, $fechaFinal) {
            $q->where(function ($subQ) use ($fechaInicio, $fechaFinal) {
                // Caso 1: La nueva competencia empieza durante otra competencia
                $subQ
                    ->where('fec_inicio', '<=', $fechaInicio)
                    ->where('fec_final', '>=', $fechaInicio);
            })->orWhere(function ($subQ) use ($fechaInicio, $fechaFinal) {
                // Caso 2: La nueva competencia termina durante otra competencia
                $subQ
                    ->where('fec_inicio', '<=', $fechaFinal)
                    ->where('fec_final', '>=', $fechaFinal);
            })->orWhere(function ($subQ) use ($fechaInicio, $fechaFinal) {
                // Caso 3: La nueva competencia engloba completamente a otra
                $subQ
                    ->where('fec_inicio', '>=', $fechaInicio)
                    ->where('fec_final', '<=', $fechaFinal);
            });
        });

        if ($excludeId) {
            $query->where('idcompetencia', '!=', $excludeId);
        }

        // Excluir competencias canceladas
        $estadoCancelado = EstadoCompetencia::where('estadocompe', 'Cancelada')->first();
        if ($estadoCancelado) {
            $query->where('fk_estado_compe', '!=', $estadoCancelado->idestado_compe);
        }

        $conflictos = $query->with('estado')->get();

        if ($conflictos->count() > 0) {
            $nombreConflicto = $conflictos->first()->nomcompe;
            throw new \Exception("Las fechas seleccionadas entran en conflicto con la competencia: {$nombreConflicto}");
        }
    }

    /**
     * Validar que solo haya una competencia activa
     */
    private function validateActiveCompetition($estadoId, $excludeId = null)
    {
        $estadoActivo = EstadoCompetencia::where('estadocompe', 'Activa')->first();

        if ($estadoActivo && $estadoId == $estadoActivo->idestado_compe) {
            $query = Competencia::where('fk_estado_compe', $estadoActivo->idestado_compe);

            if ($excludeId) {
                $query->where('idcompetencia', '!=', $excludeId);
            }

            $competenciaActiva = $query->first();

            if ($competenciaActiva) {
                throw new \Exception("Ya existe una competencia activa: {$competenciaActiva->nomcompe}. Solo puede haber una competencia activa a la vez.");
            }
        }
    }

    /**
     * Obtener competencias para filtrado AJAX
     */
    public function filter(Request $request)
    {
        $query = Competencia::with(['estado', 'tipo'])->withCount('retos');

        if ($request->filled('search')) {
            $query->where('nomcompe', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('estado')) {
            $query->where('fk_estado_compe', $request->estado);
        }

        if ($request->filled('tipo')) {
            $query->where('fk_tipo_compe', $request->tipo);
        }

        $competencias = $query->orderBy('fec_inicio', 'desc')->get();

        return response()->json([
            'success' => true,
            'competencias' => $competencias
        ]);
    }
}
