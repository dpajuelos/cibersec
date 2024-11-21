<?php

namespace App\Http\Controllers;

use App\Models\Juegos;
use App\Models\Perfiles;
use App\Models\Soluciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JuegoController extends Controller
{
    public function updateJuego(Request $request, $idreto)
    {
        
        $flag = $request->input('flag');
        if (is_null($flag)) {
            return response()->json(['success' => false, 'error' => 'Flag no proporcionada.'], 400);
        }
        $perfilId = Perfiles::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
            ->where('usuarios.idusuario', Auth::id())
            ->select('perfiles.idperfil')
            ->first()->idperfil;
        $tiempo = Carbon::now()->setTimezone('America/Lima');

        $juego = Juegos::updateOrCreate(
            ['fk_retos' => $idreto, 'fk_perfil' => $perfilId],
            [
                'tiempo' => $tiempo,
                'cantidad' => \DB::raw('cantidad + 1'), 
                'bandera_enviada' => $flag,
                'fk_resultado' => $this->isFlagCorrect($flag, $idreto) ? 1 : 2
            ]
        );

        $resultadoMensaje = ($juego->fk_resultado == 1) 
        ? 'Ha respondido correctamente !!! :) ' 
        : 'Fallaste, Sigue intentando ^-^';

        return response()->json(['success' => true, 'message' => '¡Tu flag ha sido enviada!', 'result'=>$resultadoMensaje]);
    }

    private function isFlagCorrect($flag, $idreto) {
        $result = Soluciones::join('retos', 'soluciones.fk_retos', '=', 'retos.idretos')
            ->where('retos.idretos', $idreto)
            ->where('soluciones.contenido', $flag)
            ->exists();
        return $result;
    }
}