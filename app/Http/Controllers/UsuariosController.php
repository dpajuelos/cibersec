<?php
namespace App\Http\Controllers;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UsuariosController extends Controller
{
    
    public function index()
    {
        $usuarios = Usuarios::paginate(10); 
        return view('usuario', compact('usuarios')); 
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
             $usuarios = Usuarios::paginate(10);
         } else {
             $usuarios = Usuarios::where('usuario', 'LIKE', '%' . $query . '%')
                         ->orWhere('nickname', 'LIKE', '%' . $query . '%')
                         ->orWhere('nomuniversidad', 'LIKE', '%' . $query . '%')
                         ->paginate(10);
         }
         $categorias =  DB::table('categorias')->select('nomcategoria')->get();
         return view('usuario', compact('usuarios','categorias'));
     }
    public function filtrarusuarios(Request $request)
    {
        $status = $request->input('estado');
        $usuarios = Usuarios::query();
        if ($status) {
            $usuarios = $usuarios->where('estadousuario', $status);
        }
        $usuarios = $usuarios->paginate(10);
        $categorias =  DB::table('categorias')->select('nomcategoria')->get();
        return view('usuario', compact('usuarios','categorias'));
    }
    public function ordenarusuarios(Request $request)
    {
        $order = $request->input('order');
        $usuarios = Usuarios::query();
        switch ($order) {
            case 'nombre_asc':
                $usuarios = $usuarios->orderBy('usuario', 'asc');
                break;
            case 'nombre_desc':
                $usuarios = $usuarios->orderBy('usuario', 'desc');
                break;
            case 'nick_asc':
                $usuarios = $usuarios->orderBy('nickname', 'asc'); 
                break;
            case 'nick_desc':
                $usuarios = $usuarios->orderBy('nickname', 'desc'); 
                break;
        }
        $usuarios = $usuarios->paginate(10);
        $categorias =  DB::table('categorias')->select('nomcategoria')->get();
        return view('usuario', compact('usuarios','categorias'));
    }
    
}