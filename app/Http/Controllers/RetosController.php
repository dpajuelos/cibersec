<?php

namespace App\Http\Controllers;

use App\Models\Reto;
use App\Models\Pistas;
use App\Models\User;
use App\Models\Perfil;
use App\Models\juegos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RetosController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $perfilId = Perfil::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
            ->where('usuarios.idusuario', Auth::id())
            ->select('perfiles.idperfil')
            ->first()->idperfil;
            
            

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
                    DB::raw('IF(MAX(sp.idsolve IS NOT NULL), 1, 0) AS resuelto')
                )
                ->join('niveles_reto AS lvl', 'rt.fk_nivel', '=', 'lvl.idnivel_reto')
                ->join('categorias AS ct', 'rt.fk_categoria', '=', 'ct.idcategoria')
                ->join('estados_reto AS et', 'rt.fk_estado_reto', '=', 'et.idestado_reto')
                ->leftJoin('archivos_reto AS pt', 'pt.fk_retos', '=', 'rt.idretos')
                
                // Submissions del usuario actual
                ->leftJoin('submissions_personas AS sb', function ($join) use ($perfilId) {
                    $join->on('sb.fk_idretos', '=', 'rt.idretos')
                        ->where('sb.fk_idregistros', '=', $perfilId);
                })

                // Solve relacionado al intento
                ->leftJoin('solve_personas AS sp', 'sp.fk_idsubmissions_personas', '=', 'sb.idsubmissions_personas')

                ->where('et.estadoreto', '=', 'Activo')

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
            return view('retos', compact('retosPorCategoria'));
    
        } else {
                   
            $retos = DB::table('retos AS rt')
                ->select(
                    'rt.idretos',
                    'rt.nomreto',
                    'rt.puntos',
                    'rt.descripcion',
                    'ct.nomcategoria',
                    DB::raw('0 AS resuelto')   // siempre 0 para no autenticados
                )
                ->join('categorias AS ct', 'rt.fk_categoria', '=', 'ct.idcategoria')
                ->join('estados_reto AS et', 'rt.fk_estado_reto', '=', 'et.idestado_reto')
                ->where('et.estadoreto', 'Activo')
                ->get();

            // 2) Agrupar en la colección por nomcategoria
            $retosPorCategoria = $retos->groupBy('nomcategoria');

            return view('retos', compact('retosPorCategoria'));
        }
        
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
        $retosHasPistasId = $request->input('idpista'); // ID de retos_has_pistas

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

        $puntosFinales = max(0, $reto->puntos - $pistasUsadas); // Nunca menos de 0

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
        ->join('retos as r', 's.fk_idretos', '=', 'r.idretos')
        ->select('us.usuario', 'sp.time')
        ->where('s.fk_idretos', $idreto)
        ->orderBy('sp.time', 'desc')
        ->get();

    return response()->json([
        'count' => $resueltos->count(),
        'data' => $resueltos
    ]);
    }







}