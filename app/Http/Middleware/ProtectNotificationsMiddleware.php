<?php

namespace App\Http\Middleware;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class ProtectNotificationsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request)
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si la ruta contiene un ID de notificación, verificar que pertenezca al usuario
        if ($request->route('id')) {
            $notificationId = $request->route('id');
            $notification = Notification::find($notificationId);

            if (!$notification || $notification->fk_idusuario !== Auth::user()->idusuario) {
                abort(403, 'No tienes permiso para acceder a esta notificación.');
            }
        }

        return $next($request);
    }
}
