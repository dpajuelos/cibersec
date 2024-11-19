<?php

namespace App\Http\Controllers;

use App\Models\Retos;
use App\Models\Pistas;
use App\Models\User;
use App\Models\juegos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RetosController extends Controller
{
    public function index()
    {

        $retos = Retos::all();

        $retosPorCategoria = $retos->groupBy('nomcategoria');

        return view('retos', compact('retosPorCategoria'));
    }

    public function detalles($id)
    {
        $detalle = Retos::find($id);

        if ($detalle) {
            return response()->json($detalle);
        }

        return response()->json(['error' => 'Reto no encontrado'], 404);
    }

    public function obtenerPistas($idretos)
    {
        $pistas = Pistas::select('idpistas','valor', 'contenido')
            ->join('reto_pistas as rp', 'rp.fk_pistas', '=', 'idpistas')
            ->join('retos as r', 'rp.fk_retos', '=', 'r.idretos')
            ->where('rp.fk_retos', $idretos)
            ->get();

        return response()->json($pistas);
    }
   
    public function obtenerResueltos($idreto)
    {
        $resueltos = DB::select('CALL obtener_retos_usuario(?)', [$idreto]);
        return response()->json($resueltos);
    }

    public function RegistroPistas(Request $request)
    {
        try {
            $request->validate([
                'idreto' => 'required',
                'idpista' => 'required',
            ]);

            $idusuario = Auth::id();
            if (!$idusuario) {
                return response()->json(['message' => 'Usuario no autenticado.'], 401);
            }

            $fk_perfil = DB::table('perfiles as pf')
                ->join('usuarios as u', 'pf.fk_usuario', '=', 'u.idusuario')
                ->where('u.idusuario', $idusuario)
                ->value('pf.idperfil');

            if (!$fk_perfil) {
                return response()->json(['message' => 'Perfil no encontrado.'], 404);
            }

            $fk_reto_pistas = DB::table('reto_pistas as rp')
                ->join('retos as r', 'rp.fk_retos', '=', 'r.idretos')
                ->join('pistas as p', 'rp.fk_pistas', '=', 'p.idpistas')
                ->where('rp.fk_pistas', $request->idpista)
                ->where('rp.fk_retos', $request->idreto)
                ->value('rp.idreto_pistas');

            if (!$fk_reto_pistas) {
                return response()->json(['message' => 'Reto pista no encontrada.'], 404);
            }

            $juego = juegos::where('fk_perfil', $fk_perfil)
                ->where('fk_retos', $request->idreto)
                ->first();

            $tiempo = Carbon::now(); 

            if ($juego) {
                $juego->cantidad += 1;
                $juego->tiempo = $tiempo;
                $juego->bandera_enviada = 0; 
                $juego->save();
            } else {
                juegos::create([
                    'fk_perfil' => $fk_perfil,
                    'fk_reto_pistas' => $fk_reto_pistas,
                    'cantidad' => 1,
                    'tiempo' => $tiempo,
                    'bandera_enviada' => 0,
                    'fk_resultado' => 2, 
                    'fk_retos' => $request->idreto, 
                ]);
            }
            return response()->json(['message' => 'Pista registrada correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al registrar la pista: ' . $e->getMessage()], 500);
        }
    }
    
}