<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
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
}
