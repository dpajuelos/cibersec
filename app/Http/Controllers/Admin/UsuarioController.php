<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Mostrar la vista de gestión de usuarios
     */
    public function index(Request $request)
    {
        // Obtener usuarios con sus relaciones
        $usuarios = User::with([
            'roles',
            'perfil.persona',
            'perfil.universidad',
            'perfil.nivel'
        ])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q
                        ->where('usuario', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('perfil.persona', function ($subQuery) use ($search) {
                            $subQuery
                                ->where('nombres', 'like', "%{$search}%")
                                ->orWhere('ape_paterno', 'like', "%{$search}%")
                                ->orWhere('ape_materno', 'like', "%{$search}%");
                        });
                });
            })
            ->when($request->estado, function ($query, $estado) {
                $query->where('fk_idestados', $estado);
            })
            ->when($request->rol, function ($query, $rol) {
                $query->whereHas('roles', function ($subQuery) use ($rol) {
                    $subQuery->where('roles.idroles', $rol);
                });
            })
            ->orderBy('fec_registro', 'desc')
            ->paginate(10)
            ->appends($request->query());

        // Obtener estados para el filtro
        $estados = Estado::all();

        // Obtener roles para el filtro
        $roles = Rol::all();

        return view('admin.a-usuarios', compact('usuarios', 'estados', 'roles'));
    }

    /**
     * Mostrar detalles de un usuario específico
     */
    public function show($id)
    {
        $usuario = User::with([
            'roles',
            'perfil.persona',
            'perfil.universidad',
            'perfil.nivel'
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'usuario' => $usuario
        ]);
    }
}
