<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $usu = DB::table('usuarios')
            ->where('usuario', $user->usuario)
            ->value('usuario');
        return view('profile.perfil1', compact('user', 'usu'));
    }

    public function categorias()
    {
        $categorias = DB::table('categorias')->select('nomcategoria')->get();
        return response()->json($categorias);
    }

    public function puesto_puntos(Request $request)
    {
        $name = $request->input('nickname');
        $puesto_puntos = DB::select('call puntos_puesto(?)', [$name]);
        if (empty($puesto_puntos)) {
            return response()->json(['message' => 'No se encontraron datos para este usuario.']);
        }
        return response()->json(['total_puntos' => $puesto_puntos[0]->total_puntos, 'puesto' => $puesto_puntos[0]->puesto]);
    }

    public function detalle(Request $request)
    {
        $nombreCompleto = $request->input('userName');

        // Obtener datos básicos del usuario
        $resultados = DB::select('CALL datos_usuario(?)', [$nombreCompleto]);

        if (empty($resultados)) {
            return response()->json(['message' => 'No se encontraron datos para este usuario.']);
        }

        // Obtener información de competencias
        $competenciasInfo = DB::table('usuarios as u')
            ->join('perfiles as p', 'u.idusuario', '=', 'p.fk_usuario')
            ->join('registros_personas as rp', 'p.idperfil', '=', 'rp.fk_perfil')
            ->join('competencias as c', 'rp.fk_competencia', '=', 'c.idcompetencia')
            ->where('u.usuario', $nombreCompleto)
            ->select(
                'c.nomcompe',
                'c.descripcion',
                'c.fec_inicio',
                'c.fec_final',
                'rp.fec_registro as fecha_registro'
            )
            ->orderBy('rp.fec_registro', 'desc')
            ->get();

        return response()->json([
            'results' => $resultados,
            'competencias' => $competenciasInfo
        ]);
    }

    public function obtenerPorcentajeAcierto(Request $request)
    {
        $nombreCompleto = $request->input('userName');
        $categoria = $request->input('categoria');

        $porcentajeAcierto = DB::select('SELECT obtener_porcentaje_acierto(?, ?) AS porcentaje_acierto', [$nombreCompleto, $categoria]);
        if (empty($porcentajeAcierto)) {
            return response()->json(['message' => 'No se encontraron datos categoría.']);
        }

        return response()->json(['porcentaje' => $porcentajeAcierto[0]->porcentaje_acierto]);
    }

    public function obtenerPuntosPorFecha(Request $request)
    {
        $nombreCompleto = $request->input('userName');
        $categoria = $request->input('categoria');

        $puntos = DB::select('call fechas_puntos(?,?)', [$nombreCompleto, $categoria]);
        if (empty($puntos)) {
            return response()->json(['message' => 'No se encontraron datos para la grafica']);
        }
        return response()->json(['puntos' => $puntos]);
    }
}
