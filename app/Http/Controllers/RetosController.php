<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use App\Models\juegos;
use App\Models\Perfil;
use App\Models\Pistas;
use App\Models\RegistroPersona;
use App\Models\Reto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RetosController extends Controller
{
    public function index()
    {
        $competenciaActiva = Competencia::where('fk_estado_compe', 3)->first();
        $usuarioRegistrado = false;
        $mensajeCompetencia = null;
        $retosPorCategoria = collect();

        // Validar si hay competencias activas
        if (!$competenciaActiva) {
            $mensajeCompetencia = 'No hay competencias activas';
            return view('retos', compact('mensajeCompetencia', 'usuarioRegistrado', 'retosPorCategoria', 'competenciaActiva'));
        }

        // Validar si la competencia está dentro del rango de fechas
        $ahora = now();
        if ($ahora < $competenciaActiva->fec_inicio) {
            $mensajeCompetencia = 'La competencia ' . $competenciaActiva->nomcompe . ' aún no ha comenzado';
            return view('retos', compact('mensajeCompetencia', 'competenciaActiva', 'usuarioRegistrado', 'retosPorCategoria'));
        } elseif ($ahora > $competenciaActiva->fec_final) {
            $mensajeCompetencia = 'La competencia ' . $competenciaActiva->nomcompe . ' ha finalizado';
            return view('retos', compact('mensajeCompetencia', 'competenciaActiva', 'usuarioRegistrado', 'retosPorCategoria'));
        }

        if (Auth::check() && $competenciaActiva) {
            $perfilId = Perfil::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
                ->where('usuarios.idusuario', Auth::id())
                ->select('perfiles.idperfil')
                ->first();

            if ($perfilId) {
                $usuarioRegistrado = RegistroPersona::where('fk_perfil', $perfilId->idperfil)
                    ->where('fk_competencia', $competenciaActiva->idcompetencia)
                    ->exists();
            }
        }

        if (Auth::check() && $usuarioRegistrado) {
            $perfilId = Perfil::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
                ->where('usuarios.idusuario', Auth::id())
                ->select('perfiles.idperfil')
                ->first()
                ->idperfil;
            $registroID = DB::table('registros_personas')
                ->where('fk_perfil', $perfilId)
                ->value('idregistros');

            $retos = DB::table('retos AS rt')
                ->select(
                    'rt.idretos',
                    'rt.nomreto',
                    'rt.puntos',
                    'rt.descripcion',
                    'ct.nomcategoria',
                    'pt.nombre',
                    'pt.url',
                    'pt.tipo',
                    DB::raw('COALESCE(MAX(sp.idsolve), 0) > 0 AS resuelto'),
                    DB::raw('(SELECT COUNT(*) FROM submissions_personas AS sub WHERE sub.fk_idretos = rt.idretos AND sub.fk_idregistros = ' . $registroID . ') AS intentos')
                )
                ->join('categorias AS ct', 'rt.fk_categoria', '=', 'ct.idcategoria')
                ->join('estados_reto AS et', 'rt.fk_estado_reto', '=', 'et.idestado_reto')
                ->join('competencias AS c', 'rt.fk_competencia', '=', 'c.idcompetencia')
                ->leftJoin('archivos_reto AS pt', 'pt.fk_retos', '=', 'rt.idretos')
                ->leftJoin('submissions_personas AS sb', function ($join) use ($registroID) {
                    $join
                        ->on('sb.fk_idretos', '=', 'rt.idretos')
                        ->where('sb.fk_idregistros', '=', $registroID);
                })
                ->leftJoin('solve_personas AS sp', 'sp.fk_idsubmissions_personas', '=', 'sb.idsubmissions_personas')
                ->where('et.estadoreto', '=', 'Activo')
                ->where('c.fk_estado_compe', 3)
                ->groupBy(
                    'rt.idretos',
                    'rt.nomreto',
                    'rt.puntos',
                    'rt.descripcion',
                    'ct.nomcategoria',
                    'pt.nombre',
                    'pt.url',
                    'pt.tipo'
                )
                ->get();

            $retosPorCategoria = $retos->groupBy('nomcategoria');
        } else {
            $retos = DB::table('retos AS rt')
                ->select(
                    'rt.idretos',
                    'rt.nomreto',
                    'rt.puntos',
                    'rt.descripcion',
                    'ct.nomcategoria',
                    'pt.nombre',
                    'pt.url',
                    'pt.tipo',
                    DB::raw('0 AS resuelto'),
                    DB::raw('0 AS intentos')
                )
                ->join('categorias AS ct', 'rt.fk_categoria', '=', 'ct.idcategoria')
                ->join('estados_reto AS et', 'rt.fk_estado_reto', '=', 'et.idestado_reto')
                ->join('competencias AS c', 'rt.fk_competencia', '=', 'c.idcompetencia')
                ->leftJoin('archivos_reto AS pt', 'pt.fk_retos', '=', 'rt.idretos')
                ->where('et.estadoreto', 'Activo')
                ->where('c.fk_estado_compe', 3)
                ->get();

            $retosPorCategoria = $retos->groupBy('nomcategoria');
        }

        return view('retos', compact('retosPorCategoria', 'competenciaActiva', 'usuarioRegistrado', 'mensajeCompetencia'));
    }

    public function registrarEnCompetencia(Request $request, $competenciaId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Debes iniciar sesión'
            ]);
        }

        $competencia = Competencia::find($competenciaId);
        if (!$competencia || $competencia->fk_estado_compe != 3) {
            return response()->json([
                'success' => false,
                'message' => 'Competencia no disponible'
            ]);
        }

        $perfil = Perfil::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
            ->where('usuarios.idusuario', Auth::id())
            ->select('perfiles.idperfil')
            ->first();

        if (!$perfil) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el perfil del usuario'
            ]);
        }

        $yaRegistrado = RegistroPersona::where('fk_perfil', $perfil->idperfil)
            ->where('fk_competencia', $competenciaId)
            ->exists();

        if ($yaRegistrado) {
            return response()->json([
                'success' => false,
                'message' => 'Ya estás registrado en esta competencia'
            ]);
        }

        RegistroPersona::create([
            'fec_registro' => now(),
            'fk_perfil' => $perfil->idperfil,
            'fk_competencia' => $competenciaId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Te has registrado exitosamente en la competencia'
        ]);
    }

    public function getPistas($idreto)
    {
        $perfilId = Perfil::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
            ->where('usuarios.idusuario', Auth::id())
            ->value('idperfil');

        $regId = DB::table('registros_personas')
            ->where('fk_perfil', $perfilId)
            ->value('idregistros');

        $pistas = DB::table('retos_has_pistas AS rhp')
            ->join('pistas AS pt', 'pt.idpistas', '=', 'rhp.fk_idpistas')
            ->where('rhp.fk_idretos', $idreto)
            ->select('rhp.idretos_has_pistas', 'pt.contenido', 'pt.valor')
            ->get()
            ->map(function ($pista) use ($regId) {
                $usada = DB::table('hitlog_personas')
                    ->where('fk_idretos_has_pistas', $pista->idretos_has_pistas)
                    ->where('fk_idregistros', $regId)
                    ->exists();

                return [
                    'id' => $pista->idretos_has_pistas,
                    'contenido' => $usada ? $pista->contenido : null,
                    'usada' => $usada,
                    'valor' => $pista->valor,
                ];
            });

        return response()->json($pistas);
    }

    public function desbloquearPista(Request $request)
    {
        $retosHasPistasId = $request->input('idpista');  // ID de retos_has_pistas

        $perfilId = Perfil::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
            ->where('usuarios.idusuario', Auth::id())
            ->value('idperfil');

        $regId = DB::table('registros_personas')
            ->where('fk_perfil', $perfilId)
            ->value('idregistros');

        // Verificar si ya existe para evitar duplicados
        $existe = DB::table('hitlog_personas')
            ->where('fk_idretos_has_pistas', $retosHasPistasId)
            ->where('fk_idregistros', $regId)
            ->exists();

        if (!$existe) {
            DB::table('hitlog_personas')->insert([
                'fecha' => now(),
                'fk_idretos_has_pistas' => $retosHasPistasId,
                'fk_idregistros' => $regId,
            ]);
        }

        // Obtener contenido y valor de la pista
        $pista = DB::table('retos_has_pistas as rhp')
            ->join('pistas as pt', 'pt.idpistas', '=', 'rhp.fk_idpistas')
            ->where('rhp.idretos_has_pistas', $retosHasPistasId)
            ->select('pt.contenido', 'pt.valor')
            ->first();

        if (!$pista) {
            return response()->json([
                'success' => false,
                'mensaje' => 'No se encontró la pista'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'contenido' => $pista->contenido,
            'valor' => $pista->valor,
        ]);
    }

    public function validarFlag(Request $request)
    {
        $request->validate([
            'idreto' => 'required|integer',
            'flag' => 'required|string',
        ]);

        $idreto = $request->input('idreto');
        $flagIngresada = trim($request->input('flag'));

        // Obtener el registro del usuario actual
        $perfilId = Perfil::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
            ->where('usuarios.idusuario', Auth::id())
            ->value('idperfil');

        $regId = DB::table('registros_personas')
            ->where('fk_perfil', $perfilId)
            ->value('idregistros');

        // Obtener la flag y puntos del reto
        $reto = DB::table('retos')
            ->select('flag', 'puntos')
            ->where('idretos', $idreto)
            ->first();

        if (!$reto) {
            return response()->json([
                'success' => false,
                'mensaje' => 'No se encontró el reto especificado.',
            ]);
        }

        $flagCorrecta = $reto->flag;

        // Insertar en submissions_personas (correcto o incorrecto)
        $esCorrecta = $flagIngresada === $flagCorrecta ? 1 : 0;

        $submissionId = DB::table('submissions_personas')->insertGetId([
            'fecha' => now(),
            'flag_enviada' => $flagIngresada,
            'correcto?' => $esCorrecta,
            'fk_idretos' => $idreto,
            'fk_idregistros' => $regId,
        ]);

        if (!$esCorrecta) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Flag incorrecta.',
            ]);
        }

        // Si ya resolvió antes, no insertar en solve_personas de nuevo
        $yaResuelto = DB::table('solve_personas')
            ->join('submissions_personas', 'solve_personas.fk_idsubmissions_personas', '=', 'submissions_personas.idsubmissions_personas')
            ->where('submissions_personas.fk_idretos', $idreto)
            ->where('submissions_personas.fk_idregistros', $regId)
            ->exists();

        if ($yaResuelto) {
            return response()->json([
                'success' => true,
                'mensaje' => 'Flag correcta, pero ya resolviste este reto XD',
            ]);
        }

        // Calcular el puntaje restando el valor de las pistas usadas por el usuario
        $pistasUsadas = DB::table('hitlog_personas AS h')
            ->join('retos_has_pistas AS rhp', 'rhp.idretos_has_pistas', '=', 'h.fk_idretos_has_pistas')
            ->join('pistas AS pt', 'pt.idpistas', '=', 'rhp.fk_idpistas')
            ->where('rhp.fk_idretos', $idreto)
            ->where('h.fk_idregistros', $regId)
            ->sum('pt.valor');

        $puntosFinales = max(0, $reto->puntos - $pistasUsadas);  // Nunca menos de 0

        // Insertar en solve_personas
        DB::table('solve_personas')->insert([
            'puntos' => $puntosFinales,
            'time' => now(),
            'fk_idsubmissions_personas' => $submissionId,
        ]);

        return response()->json([
            'success' => true,
            'mensaje' => "¡Flag correcta! Obtuviste {$puntosFinales} puntos.",
        ]);
    }

    public function obtenerResueltos($idreto)
    {
        $resueltos = DB::table('solve_personas as sp')
            ->join('submissions_personas as s', 'sp.fk_idsubmissions_personas', '=', 's.idsubmissions_personas')
            ->join('registros_personas as rp', 's.fk_idregistros', '=', 'rp.idregistros')
            ->join('perfiles as p', 'rp.fk_perfil', '=', 'p.idperfil')
            ->join('usuarios as us', 'p.fk_usuario', '=', 'us.idusuario')
            ->leftJoin('hitlog_personas as h', function ($join) use ($idreto) {
                $join
                    ->on('h.fk_idregistros', '=', 'rp.idregistros')
                    ->join('retos_has_pistas as rhp', 'h.fk_idretos_has_pistas', '=', 'rhp.idretos_has_pistas')
                    ->where('rhp.fk_idretos', $idreto);
            })
            ->leftJoin('pistas as pt', 'h.fk_idretos_has_pistas', '=', 'pt.idpistas')
            ->select(
                'us.usuario',
                'sp.time',
                'sp.puntos',
                DB::raw('COALESCE(SUM(pt.valor), 0) as pistas_usadas')
            )
            ->where('s.fk_idretos', $idreto)
            ->groupBy('us.usuario', 'sp.time', 'sp.puntos', 'sp.idsolve')
            ->orderBy('sp.time', 'asc')
            ->get();

        return response()->json([
            'count' => $resueltos->count(),
            'data' => $resueltos
        ]);
    }

    public function contarIntentos($idreto)
    {
        $count = DB::table('submissions_personas')
            ->where('fk_idretos', $idreto)
            ->count();
        return response()->json(['count' => $count]);
    }
}
