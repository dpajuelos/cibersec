<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class AdminMiddleware
{
    /**
     * Handle Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta área.');
        }

        $user = Auth::user();

        // Verificar si el usuario tiene el rol de administrador
        $hasAdminRole = $user->roles->contains(function ($role) {
            return strtolower($role->namerol) === 'administrador';
        });

        if (!$hasAdminRole) {
            abort(403, 'No tienes permisos para acceder a esta sección de administración.');
        }

        return $next($request);
    }
}