<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Número máximo de intentos de login
     */
    const MAX_LOGIN_ATTEMPTS = 5;

    /**
     * Tiempo de bloqueo en minutos
     */
    const LOCKOUT_TIME = 15;

    public function showLoginForm(Request $request)
    {
        if (!$request->session()->has('url.intended')) {
            $request->session()->put('url.intended', url()->previous());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Verificar rate limiting
        $this->checkTooManyFailedAttempts($request);

        // Cargar usuario con sus roles directamente
        $user = User::with('roles')->where('email', $request->email)->first();

        // Verificar existencia del usuario y estado activo
        if (!$user || !$user->isActive()) {
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }

        // Verificar contraseña
        if (!Hash::check($request->password, $user->password)) {
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }

        // Login exitoso
        $this->clearLoginAttempts($request);
        Auth::login($user);

        // Regenerar session ID para prevenir session fixation
        $request->session()->regenerate();

        // Determinar redirección según el rol
        $redirectTo = $this->getRedirectPath($user);

        return redirect($redirectTo);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        // Invalidar la sesión y regenerar token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Determinar la ruta de redirección según el rol del usuario
     */
    protected function getRedirectPath(User $user): string
    {
        $hasAdminRole = $user->roles->contains(function ($role) {
            return strtolower($role->namerol) === 'administrador';
        });

        \Log::info('Admin role check result', [
            'hasAdminRole' => $hasAdminRole,
            'redirect_to' => $hasAdminRole ? '/admin' : '/'
        ]);

        if ($hasAdminRole) {
            return '/admin';
        }

        return '/';
    }

    /**
     * Verificar si el usuario tiene un rol específico
     */
    protected function hasRole(User $user, string $roleName): bool
    {
        return $user->roles->contains(function ($role) use ($roleName) {
            return strtolower($role->namerol) === strtolower($roleName);
        });
    }

    /**
     * Verificar demasiados intentos fallidos
     */
    protected function checkTooManyFailedAttempts(Request $request)
    {
        $key = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($key, self::MAX_LOGIN_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($key);

            \Log::warning('Login attempts exceeded', [
                'ip' => $request->ip(),
                'email' => $request->email,
                'attempts' => RateLimiter::attempts($key)
            ]);

            throw ValidationException::withMessages([
                'email' => ['Demasiados intentos de inicio de sesión. Inténtalo de nuevo en ' . ceil($seconds / 60) . ' minutos.'],
            ]);
        }
    }

    /**
     * Incrementar intentos de login
     */
    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request), self::LOCKOUT_TIME * 60);

        \Log::warning('Failed login attempt', [
            'ip' => $request->ip(),
            'email' => $request->email,
            'user_agent' => $request->userAgent()
        ]);
    }

    /**
     * Limpiar intentos de login
     */
    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    /**
     * Obtener la clave de throttle
     */
    protected function throttleKey(Request $request): string
    {
        return strtolower($request->input('email')) . '|' . $request->ip();
    }

    /**
     * Respuesta para login fallido
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas.',
        ])->withInput($request->except('password'));
    }
}
