<?php
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\CompetenciaController;
use App\Http\Controllers\Admin\NotificacionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\RetoController;
use App\Http\Controllers\RetosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/profile', function () {
    return view('profile.show');
})->name('profile');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

Route::get('/universidades', [RegisterController::class, 'universidades']);

Route::get('/detalles/{id}', [RetosController::class, 'detalles']);

Route::middleware(['auth'])->group(function () {
    Route::get('/resueltos/{id}', [RetosController::class, 'obtenerResueltos']);
    Route::get('/intentos/{idreto}', [RetosController::class, 'contarIntentos']);
    Route::get('/pistas/{idreto}', [RetosController::class, 'getPistas']);

    Route::post('/pistas/desbloquear', [RetosController::class, 'desbloquearPista']);
    Route::post('/retos/validar-flag', [RetosController::class, 'validarFlag']);
});

Route::post('/retos/{idreto}/{idpista}', [RetosController::class, 'registrarPista']);

Route::get('/retos', [RetosController::class, 'index'])->name('retos');

Route::post('/juegos/{idreto}', [JuegoController::class, 'updateJuego']);

// Rutas para usuarios
Route::get('/usuario', [UsuariosController::class, 'index'])->name('usuarios');

// Ruta para la búsqueda
Route::get('/usuarios/buscar', [UsuariosController::class, 'buscar'])->name('usuarios.buscar');

// Ruta para obtener información detallada del usuario (para el modal)
Route::get('/usuarios/{usuario}/{nickname}', [UsuariosController::class, 'show'])->name('usuarios.show');

// Ruta para estadísticas
Route::get('/usuarios/estadisticas', [UsuariosController::class, 'estadisticas'])->name('usuarios.estadisticas');

Route::get('/categorias', [RankingController::class, 'categorias']);

Route::get('/usuarios/puesto_puntos', [UsuariosController::class, 'puesto_puntos'])->name('usuarios.puestopunto');

Route::get('/usuarios/detalle', [UsuariosController::class, 'detalle'])->name('usuarios.detalle');

Route::post('/usuarios/porcentaje-acierto', [UsuariosController::class, 'obtenerPorcentajeAcierto']);

Route::post('/usuarios/puntos-por-fecha', [UsuariosController::class, 'obtenerPuntosPorFecha']);

Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');

Route::get('/rankings/top5', [RankingController::class, 'getTop5']);

Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    return view('welcome');
})->name('dashboard');


// Rutas para el perfil del usuario
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil1', [PerfilController::class, 'index'])->name('profile.perfil1');
});

// Rutas de administración
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard principal
    Route::get('/', function () {
        return view('admin.main');
    })->name('dashboard');

    // Gestión de retos (challenges)
    Route::get('/challenges', [\App\Http\Controllers\Admin\RetoController::class, 'index'])->name('challenges');
    Route::post('/challenges', [\App\Http\Controllers\Admin\RetoController::class, 'store'])->name('challenges.create');
    Route::get('/challenges/{id}/edit', [\App\Http\Controllers\Admin\RetoController::class, 'edit'])->name('challenges.edit');
    Route::put('/challenges/{id}', [\App\Http\Controllers\Admin\RetoController::class, 'update'])->name('challenges.update');
    Route::delete('/challenges/{id}', [\App\Http\Controllers\Admin\RetoController::class, 'destroy'])->name('challenges.destroy');
    // Elimina todas las pistas de un reto
    Route::delete('/challenges/{retoId}/pistas/{pistaId}', [\App\Http\Controllers\Admin\RetoController::class, 'eliminarPista'])->name('challenges.pistas.destroy');
    Route::delete('/challenges/{retoId}/archivo', [\App\Http\Controllers\Admin\RetoController::class, 'eliminarArchivo'])->name('challenges.archivo.destroy');
    // Elimina pistas específicas de un reto
    Route::delete('/admin/challenges/{reto}/pistas/{pista}', [RetoController::class, 'eliminarPista'])->name('admin.retos.eliminar-pista');
    // Gestión de categorías - Rutas actualizadas
    Route::get('/categories', [CategoriaController::class, 'index'])->name('categories');
    Route::get('/categories/search', [CategoriaController::class, 'search'])->name('categories.search');  // Nueva ruta
    Route::post('/categories', [CategoriaController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategoriaController::class, 'show'])->name('categories.show');
    Route::put('/categories/{id}', [CategoriaController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoriaController::class, 'destroy'])->name('categories.delete');
    Route::get('/categories/stats', [CategoriaController::class, 'estadisticas'])->name('categories.stats');

    // Sistema de notificaciones
    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notifications');
    Route::post('/notificaciones', [NotificacionController::class, 'store'])->name('notifications.store');
    Route::get('/notificaciones/{id}', [NotificacionController::class, 'show'])->name('notifications.show');
    Route::delete('/notificaciones/{id}', [NotificacionController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notificaciones/buscar/usuarios', [NotificacionController::class, 'buscarUsuarios'])->name('notifications.buscar-usuarios');
    Route::post('/notificaciones/filtrar', [NotificacionController::class, 'filtrar'])->name('notifications.filtrar');

    // Rutas para competencias
    Route::get('/competencias', [CompetenciaController::class, 'index'])->name('competitions');
    Route::get('/competencias/create', [CompetenciaController::class, 'create'])->name('competitions.create');
    Route::post('/competencias', [CompetenciaController::class, 'store'])->name('competitions.store');
    Route::get('/competencias/{competencia}', [CompetenciaController::class, 'show'])->name('competitions.show');
    Route::get('/competencias/{competencia}/edit', [CompetenciaController::class, 'edit'])->name('competitions.edit');
    Route::put('/competencias/{competencia}', [CompetenciaController::class, 'update'])->name('competitions.update');
    Route::delete('/competencias/{competencia}', [CompetenciaController::class, 'destroy'])->name('competitions.destroy');
    Route::post('/competencias/{competencia}/activate', [CompetenciaController::class, 'activate'])->name('competitions.activate');
    Route::post('/competencias/{competencia}/finalize', [CompetenciaController::class, 'finalize'])->name('competitions.finalize');
    Route::get('/competencias-filter', [CompetenciaController::class, 'filter'])->name('competitions.filter');

    // Rutas para usuarios
    Route::get('/users', [\App\Http\Controllers\Admin\UsuarioController::class, 'index'])->name('users');

    // Configuración del sistema
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    // Logs y monitoreo
    Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
    Route::get('/system-status', [AdminController::class, 'systemStatus'])->name('system.status');

    // Analytics y estadísticas
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/analytics/users', [AdminController::class, 'userAnalytics'])->name('analytics.users');
    Route::get('/analytics/challenges', [AdminController::class, 'challengeAnalytics'])->name('analytics.challenges');

    // APIs para datos en tiempo real
    Route::get('/api/stats', [AdminController::class, 'getStats'])->name('api.stats');
    Route::get('/api/activity', [AdminController::class, 'getActivity'])->name('api.activity');
    Route::get('/api/system-health', [AdminController::class, 'getSystemHealth'])->name('api.system-health');
});

// Rutas de notificaciones para usuarios
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/notificaciones/{id}/marcar-leida',
            [NotificationController::class, 'marcarLeida'])
        ->middleware('protect.notifications')
        ->name('notificaciones.marcar-leida');

    Route::post('/notificaciones/marcar-todas-leidas',
        [NotificationController::class, 'marcarTodasLeidas'])->name('notificaciones.marcar-todas-leidas');
});
