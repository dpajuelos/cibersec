<?php

namespace App\Http\Controllers;

use App\Models\Universidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    /**
     * Mostrar la lista de usuarios con paginación
     */
    public function index()
    {
        $v_usuarios = $this->getUsuarios();
        $universidades = Universidad::all();

        return view('usuario', compact('v_usuarios', 'universidades'));
    }

    /**
     * Buscar usuarios con filtros y búsqueda en tiempo real
     */
    public function buscar(Request $request)
    {
        $v_usuarios = $this->getUsuarios($request);

        if ($request->ajax() || $request->has('ajax')) {
            // Retornar JSON para peticiones AJAX
            return response()->json([
                'html' => view('layouts.partials.usuarios-table', compact('v_usuarios'))->render(),
                'pagination' => view('layouts.partials.usuarios-pagination', compact('v_usuarios'))->render(),
                'stats' => [
                    'total' => $v_usuarios->total(),
                    'current_page' => $v_usuarios->currentPage(),
                    'last_page' => $v_usuarios->lastPage()
                ]
            ]);
        }

        $universidades = Universidad::all();
        return view('usuario', compact('v_usuarios', 'universidades'));
    }

    /**
     * Método unificado para obtener usuarios con filtros
     */
    private function getUsuarios(Request $request = null)
    {
        $query = User::join('perfiles', 'usuarios.idusuario', '=', 'perfiles.fk_usuario')
            ->join('personas', 'perfiles.fk_persona', '=', 'personas.dni')
            ->join('universidades', 'perfiles.fk_universidad', '=', 'universidades.iduniversidad')
            ->select(
                'usuarios.usuario as nickname',
                'usuarios.profile_photo_path',
                'usuarios.fk_idestados as estadousuario',
                'personas.dni',
                'perfiles.link',
                'universidades.nomuniversidad',
                'universidades.iduniversidad',
                DB::raw("CONCAT(personas.nombres, ' ', personas.ape_paterno, ' ', personas.ape_materno) as usuario")
            );

        if ($request) {
            // Aplicar filtro de búsqueda
            if ($request->filled('buscar')) {
                $buscar = $request->input('buscar');
                $query->where(function ($q) use ($buscar) {
                    $q
                        ->where('usuarios.usuario', 'LIKE', "%{$buscar}%")
                        ->orWhere('personas.nombres', 'LIKE', "%{$buscar}%")
                        ->orWhere('personas.ape_paterno', 'LIKE', "%{$buscar}%")
                        ->orWhere('personas.ape_materno', 'LIKE', "%{$buscar}%")
                        ->orWhere('universidades.nomuniversidad', 'LIKE', "%{$buscar}%");
                });
            }

            // Aplicar filtro de estado
            if ($request->filled('estado') && $request->input('estado') !== 'todos') {
                $query->where('usuarios.fk_idestados', $request->input('estado'));
            }

            // Aplicar filtro de universidad
            if ($request->filled('universidad') && $request->input('universidad') !== 'todas') {
                if ($request->input('universidad') === 'unasam') {
                    $query->where('universidades.nomuniversidad', 'LIKE', '%UNASAM%');
                } elseif ($request->input('universidad') === 'otras') {
                    $query->where('universidades.nomuniversidad', 'NOT LIKE', '%UNASAM%');
                }
            }

            // Aplicar ordenamiento
            if ($request->filled('orden')) {
                switch ($request->input('orden')) {
                    case 'nombre_asc':
                        $query->orderBy('personas.nombres', 'asc');
                        break;
                    case 'nombre_desc':
                        $query->orderBy('personas.nombres', 'desc');
                        break;
                    case 'universidad':
                        $query->orderBy('universidades.nomuniversidad', 'asc');
                        break;
                    case 'estado':
                        $query->orderBy('usuarios.fk_idestados', 'desc');
                        break;
                    default:
                        $query->orderBy('personas.nombres', 'asc');
                }
            } else {
                $query->orderBy('personas.nombres', 'asc');
            }
        }

        return $query->paginate(10);
    }

    public function show($usuario, $nickname)
    {
        $usuarioInfo = User::join('perfiles', 'usuarios.idusuario', '=', 'perfiles.fk_usuario')
            ->join('personas', 'perfiles.fk_persona', '=', 'personas.dni')
            ->join('universidades', 'perfiles.fk_universidad', '=', 'universidades.iduniversidad')
            ->leftJoin('niveles', 'perfiles.fk_nivel', '=', 'niveles.idnivel')
            ->select(
                'usuarios.usuario',
                'usuarios.email',
                'usuarios.fec_registro',
                'usuarios.profile_photo_path',
                'personas.nombres',
                'personas.ape_paterno',
                'personas.ape_materno',
                'perfiles.biografia as perfil_descripcion',
                'perfiles.link',
                'universidades.nomuniversidad',
                'niveles.nomnivel'
            )
            ->where('usuarios.usuario', $nickname)
            ->where(DB::raw("CONCAT(personas.nombres, ' ', personas.ape_paterno, ' ', personas.ape_materno)"), 'LIKE', "%{$usuario}%")
            ->first();

        if (!$usuarioInfo) {
            return response()->json([
                'error' => 'Usuario no encontrado',
                'easter_egg' => [
                    'message' => '¡Oops! Este usuario parece haberse escondido en el ciberespacio',
                    'code' => 404,
                    'image' => '/images/404-hacker.png'
                ]
            ], 404);
        }

        // Obtener competencias del usuario
        $competencias = DB::table('competencias')
            ->join('registros_personas', 'competencias.idcompetencia', '=', 'registros_personas.fk_competencia')
            ->join('perfiles', 'registros_personas.fk_perfil', '=', 'perfiles.idperfil')
            ->where('perfiles.fk_usuario', $usuarioInfo->idusuario)
            ->select(
                'competencias.idcompetencia',
                'competencias.nomcompe as nomcompetencia',
                'competencias.descripcion',
                'registros_personas.fec_registro as fecha_registro'
            )
            ->get();

        return response()->json([
            'usuario' => $usuarioInfo,
            'competencias' => $competencias
        ]);
    }

    // ...existing code...

    /**
     * Obtener estadísticas de usuarios
     */
    public function estadisticas()
    {
        $totalUsuarios = User::count();
        $usuariosActivos = User::where('fk_idestados', 1)->count();
        $usuariosInactivos = User::where('fk_idestados', '!=', 1)->count();
        $universidades = Universidad::withCount('perfiles')->get();

        return response()->json([
            'total' => $totalUsuarios,
            'activos' => $usuariosActivos,
            'inactivos' => $usuariosInactivos,
            'universidades' => $universidades
        ]);
    }
}
