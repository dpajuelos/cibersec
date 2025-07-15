<?php

namespace App\Http\Controllers;

use App\Models\Retos;
use App\Models\Pistas;
use App\Models\User;
use App\Models\Perfiles;
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
            $perfilId = Perfiles::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
            ->where('usuarios.idusuario', Auth::id())
            ->select('perfiles.idperfil')
            ->first()->idperfil;
            
            $retos = DB::table('retos AS rt') ->select(
                'rt.idretos',
                'rt.nomreto',
                'rt.puntos',
                'rt.descripcion',
                'ct.nomcategoria',
                'pt.nombre',
                'pt.url',
                'pt.tipo',
                DB::raw('MAX(IF(j.fk_resultado=1 AND j.fk_perfil=' . $perfilId . ', 1, 0)) AS resuelto')
            )
            ->join('niveles_reto AS lvl', 'rt.fk_nivel', '=', 'lvl.idnivel_reto')
            ->join('categorias AS ct', 'rt.fk_categoria', '=', 'ct.idcategoria')
            ->join('estados_reto AS et', 'rt.fk_estado_reto', '=', 'et.idestado_reto')
            ->leftjoin('archivos_reto AS pt', 'rt.fk_archivo', '=', 'pt.idarchivo')
            ->leftJoin('juegos AS j', 'rt.idretos', '=', 'j.fk_retos')
            ->leftJoin('perfiles AS pf', 'j.fk_perfil', '=', 'pf.idperfil')
            ->where('et.estadoreto', '=', 'Activo')
            ->groupBy('rt.idretos', 'rt.nomreto', 'rt.puntos', 'rt.descripcion', 'ct.nomcategoria', 'pt.nombre', 'pt.url', 'pt.tipo')
            ->get();

            $retosPorCategoria = $retos->groupBy('nomcategoria'); 
            return view('retos', compact('retosPorCategoria'));
    
        } else {
            $retos = Retos::all();
            $retosPorCategoria = $retos->groupBy('nomcategoria');
            return view('retos', compact('retosPorCategoria'));
        }
        
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
        $idPerfil = Perfiles::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
            ->where('usuarios.idusuario', Auth::id())
            ->select('perfiles.idperfil')
            ->first()->idperfil;
    
            $pistas = Pistas::select('p.idpistas', 'p.valor', 'p.contenido', 'j.fk_reto_pistas')
            ->from('pistas as p')
            ->leftJoin('reto_pistas as rp', 'rp.fk_pistas', '=', 'p.idpistas') 
            ->leftJoin('retos as r', 'rp.fk_retos', '=', 'r.idretos')  
            ->leftJoin('juegos as j', function ($join) use ($idPerfil) {    
                $join->on('j.fk_reto_pistas', '=', 'rp.idreto_pistas')       
                     ->where('j.fk_perfil', $idPerfil);       
            })
            ->where('rp.fk_retos', $idretos)
            ->orderBy('j.fk_reto_pistas','desc') ->get();
    
        return response()->json($pistas);
    }
   
    public function obtenerResueltos($idreto)
    {
        $resueltos = DB::select('CALL obtener_retos_usuario(?)', [$idreto]);
        return response()->json($resueltos);
    }
    
    public function registrarPista($idreto, $idpista)
    {
      
        $perfilId = Perfiles::join('usuarios', 'perfiles.fk_usuario', '=', 'usuarios.idusuario')
            ->where('usuarios.idusuario', Auth::id())
            ->select('perfiles.idperfil')
            ->first()->idperfil;
    
        $fkRetoPistas = DB::table('reto_pistas as rp')
            ->join('retos as r', 'rp.fk_retos', '=', 'r.idretos')
            ->join('pistas as p', 'rp.fk_pistas', '=', 'p.idpistas')
            ->where('p.idpistas', $idpista)
            ->where('r.idretos', $idreto) 
            ->select('rp.idreto_pistas')
            ->first();
    
        if (is_null($fkRetoPistas)) {
            return response()->json(['success' => false, 'error' => 'No se encontró la pista para el reto especificado.'], 404);
        }
    
        $juego = Juegos::updateOrCreate(
            ['fk_retos' => $idreto, 'fk_perfil' => $perfilId],
            [
                'tiempo' => now(),
                'cantidad' => \DB::raw('cantidad + 1'), 
                'bandera_enviada' => 'hola',
                'fk_resultado' => '2',
                'fk_reto_pistas' => $fkRetoPistas->idreto_pistas 
            ]
        );
    
        return response()->json(['success' => true, 'message' => 'Pista registrada correctamente.']);
    }
}