<?php
namespace App\Http\Controllers;
use App\Models\v_usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class usuariosController extends Controller
{
    
    public function index()
    {
        $v_usuarios = v_usuarios::paginate(10); 
        return view('usuario', compact('v_usuarios')); 
    }
    public function categorias()
    {
        $categorias = DB::table('categorias')->select('nomcategoria')->get();
        return response()->json($categorias);
    }
    
    public function puesto_puntos(Request $request)
    {
        $name=$request->input('userDetails');
        $puesto_puntos = DB::select('call puntos_puesto(?)',[$name]);
        if (empty($puesto_puntos)) {
            return response()->json(['message' => 'No se encontraron datos para este usuario.']);
        }
        return response()->json(['total_puntos' => $puesto_puntos[0]->total_puntos, 'puesto' => $puesto_puntos[0]->puesto]);
        
    }
    
    public function detalle(Request $request)
    {
        $nombreCompleto = $request->input('userName');
        $resultados = DB::select('CALL datos_usuario(?)', [$nombreCompleto]);
        
        if (empty($resultados)) {
            return response()->json(['message' => 'No se encontraron datos para este usuario.']);
        }
        return response()->json(['results' => $resultados]);
    }
    public function obtenerPorcentajeAcierto(Request $request)
    {
        $nombreCompleto = $request->input('userName');
        $categoria = $request->input('categoria');
        
        // Ejecuta la consulta para obtener el porcentaje de aciertos
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
    public function buscarusuario(Request $request)
    {
         $query = $request->input('buscar');
 
         
         if (empty($query)) {
             $v_usuarios = v_usuarios::paginate(10);
         } else {
             $v_usuarios = v_usuarios::where('usuario', 'LIKE', '%' . $query . '%')
                         ->orWhere('nickname', 'LIKE', '%' . $query . '%')
                         ->orWhere('nomuniversidad', 'LIKE', '%' . $query . '%')
                         ->paginate(10);
         }
         $categorias =  DB::table('categorias')->select('nomcategoria')->get();
         return view('usuario', compact('v_usuarios','categorias'));
     }
    public function filtrarv_usuarios(Request $request)
    {
        $status = $request->input('estado');
        $v_usuarios = v_usuarios::query();
        if ($status) {
            $v_usuarios = $v_usuarios->where('estadousuario', $status);
        }
        $v_usuarios = $v_usuarios->paginate(10);
        $categorias =  DB::table('categorias')->select('nomcategoria')->get();
        return view('usuario', compact('v_usuarios','categorias'));
    }
    public function ordenarv_usuarios(Request $request)
    {
        $order = $request->input('order');
        $v_usuarios = v_usuarios::query();
        switch ($order) {
            case 'nombre_asc':
                $v_usuarios = $v_usuarios->orderBy('usuario', 'asc');
                break;
            case 'nombre_desc':
                $v_usuarios = $v_usuarios->orderBy('usuario', 'desc');
                break;
            case 'nick_asc':
                $v_usuarios = $v_usuarios->orderBy('nickname', 'asc'); 
                break;
            case 'nick_desc':
                $v_usuarios = $v_usuarios->orderBy('nickname', 'desc'); 
                break;
        }
        $v_usuarios = $v_usuarios->paginate(10);
        $categorias =  DB::table('categorias')->select('nomcategoria')->get();
        return view('usuario', compact('usuarios','categorias'));
    }
    
}