<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NotificacionController extends Controller
{
    public function index(Request $request)
    {
        $query = Notification::with('usuario')->orderBy('created_at', 'desc');

        // Filtrar por búsqueda de mensaje
        if ($request->filled('search')) {
            $query->where('message', 'like', '%' . $request->search . '%');
        }

        // Filtrar por estado
        if ($request->filled('estado')) {
            $query->where('is_read', $request->estado);
        }

        // Filtrar por tipo
        if ($request->filled('tipo')) {
            if ($request->tipo === 'general') {
                $query->whereNull('fk_idusuario');
            } elseif ($request->tipo === 'especifica') {
                $query->whereNotNull('fk_idusuario');
            }
        }

        $notificaciones = $query->paginate(10);

        // Estadísticas - Corregidas para tu estructura de BD
        $totalNotificaciones = Notification::count();
        $notificacionesLeidas = Notification::where('is_read', 1)->count();
        $notificacionesPendientes = Notification::where('is_read', 0)->count();
        // Cambiar email_verified_at por fk_idestados (usuarios activos)
        $usuariosActivos = User::where('fk_idestados', 1)->count();  // Asumiendo que 1 = activo

        return view('admin.a-notificaciones', compact(
            'notificaciones',
            'totalNotificaciones',
            'notificacionesLeidas',
            'notificacionesPendientes',
            'usuariosActivos'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mensaje' => 'required|string|max:500',
            'tipo_notificacion' => 'required|in:general,especifica',
            // Cambiar users,id por usuarios,idusuario
            'usuario_id' => 'nullable|exists:usuarios,idusuario|required_if:tipo_notificacion,especifica'
        ], [
            'mensaje.required' => 'El mensaje es obligatorio.',
            'mensaje.max' => 'El mensaje no puede exceder los 500 caracteres.',
            'tipo_notificacion.required' => 'Debe seleccionar un tipo de notificación.',
            'tipo_notificacion.in' => 'El tipo de notificación no es válido.',
            'usuario_id.required_if' => 'Debe seleccionar un usuario para notificaciones específicas.',
            'usuario_id.exists' => 'El usuario seleccionado no existe.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            if ($request->tipo_notificacion === 'general') {
                // Crear notificación para todos los usuarios activos
                $usuarios = User::where('fk_idestados', 1)->get();  // Cambiar email_verified_at por fk_idestados

                foreach ($usuarios as $usuario) {
                    Notification::create([
                        'fk_idusuario' => $usuario->idusuario,  // Usar idusuario en lugar de id
                        'message' => $request->mensaje,
                        'is_read' => 0
                    ]);
                }

                $mensaje = 'Notificación general enviada a ' . $usuarios->count() . ' usuarios.';
            } else {
                // Crear notificación específica
                Notification::create([
                    'fk_idusuario' => $request->usuario_id,
                    'message' => $request->mensaje,
                    'is_read' => 0
                ]);

                $usuario = User::find($request->usuario_id);
                $mensaje = 'Notificación específica enviada a ' . $usuario->usuario . '.';  // Cambiar name por usuario
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $mensaje
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al enviar la notificación: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $notificacion = Notification::with('usuario')->findOrFail($id);

        return response()->json([
            'success' => true,
            'notificacion' => [
                'id' => $notificacion->id,
                'mensaje' => $notificacion->message,
                // Cambiar name por usuario
                'usuario' => $notificacion->usuario ? $notificacion->usuario->usuario : 'Todos los usuarios',
                'tipo' => $notificacion->fk_idusuario ? 'Específica' : 'General',
                'estado' => $notificacion->is_read ? 'Leída' : 'Pendiente',
                'fecha' => $notificacion->created_at->format('d/m/Y H:i')
            ]
        ]);
    }

    public function destroy($id)
    {
        try {
            $notificacion = Notification::findOrFail($id);
            $notificacion->delete();

            return response()->json([
                'success' => true,
                'message' => 'Notificación eliminada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la notificación.'
            ], 500);
        }
    }

    public function buscarUsuarios(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        // Actualizar consulta para tu estructura
        $usuarios = User::where('fk_idestados', 1)  // Usuarios activos
            ->where(function ($q) use ($query) {
                $q
                    ->where('usuario', 'like', '%' . $query . '%')  // Cambiar name por usuario
                    ->orWhere('email', 'like', '%' . $query . '%');
            })
            ->select('idusuario as id', 'usuario as name', 'email')  // Mapear campos
            ->limit(10)
            ->get();

        return response()->json($usuarios);
    }

    public function filtrar(Request $request)
    {
        $query = Notification::with('usuario')->orderBy('created_at', 'desc');

        // Aplicar filtros
        if ($request->filled('buscar')) {
            $query->where('message', 'like', '%' . $request->buscar . '%');
        }

        if ($request->filled('estado')) {
            $query->where('is_read', $request->estado);
        }

        if ($request->filled('tipo')) {
            if ($request->tipo === 'general') {
                $query->whereNull('fk_idusuario');
            } elseif ($request->tipo === 'especifica') {
                $query->whereNotNull('fk_idusuario');
            }
        }

        $notificaciones = $query->get();

        return response()->json([
            'success' => true,
            'notificaciones' => $notificaciones->map(function ($notificacion) {
                return [
                    'id' => $notificacion->id,
                    'mensaje' => $notificacion->message,
                    // Cambiar name por usuario
                    'usuario' => $notificacion->usuario ? $notificacion->usuario->usuario : 'Todos los usuarios',
                    'usuario_email' => $notificacion->usuario ? $notificacion->usuario->email : null,
                    'tipo' => $notificacion->fk_idusuario ? 'especifica' : 'general',
                    'estado' => $notificacion->is_read,
                    'fecha' => $notificacion->created_at->format('d/m/Y'),
                    'hora' => $notificacion->created_at->format('H:i')
                ];
            })
        ]);
    }

    public function marcarLeida($id)
    {
        try {
            $notificacion = Notification::where('id', $id)
                ->where('fk_idusuario', Auth::user()->idusuario)
                ->firstOrFail();

            $notificacion->update(['is_read' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Notificación marcada como leída'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al marcar la notificación'
            ], 403);
        }
    }

    public function marcarTodasLeidas()
    {
        try {
            Notification::where('fk_idusuario', Auth::user()->idusuario)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Todas las notificaciones marcadas como leídas'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al marcar las notificaciones'
            ], 500);
        }
    }

    public function misNotificaciones()
    {
        $notificaciones = Auth::user()
            ->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('notificaciones.mis-notificaciones', compact('notificaciones'));
    }
}
