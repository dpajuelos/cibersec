<?php
use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RetosController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuario', function () {
    return view('usuario'); 
})->name('usuario');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/profile', function () {
    return view('profile.show');
})->name('profile');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

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

Route::get('/usuario', [UsuariosController::class, 'index'])->name('usuarios');

Route::get('/usuario/buscar', [UsuariosController::class, 'buscarusuario'])->name('usuarios.buscar');

Route::get('/usuario/filtrar', [UsuariosController::class, 'filtrarusuarios'])->name('usuarios.filtrar');

Route::get('/usuario/ordenar', [UsuariosController::class, 'ordenarusuarios'])->name('usuarios.ordenar');

Route::get('/categorias', [RankingController::class, 'categorias']);

Route::get('/usuarios/puesto_puntos', [UsuariosController::class, 'puesto_puntos'])->name('usuarios.puestopunto');

Route::get('/usuarios/detalle', [UsuariosController::class, 'detalle'])->name('usuarios.detalle');

Route::post('/usuarios/porcentaje-acierto', [UsuariosController::class, 'obtenerPorcentajeAcierto']);

Route::post('/usuarios/puntos-por-fecha', [UsuariosController::class, 'obtenerPuntosPorFecha']);

Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');

Route::get('/rankings/top5', [RankingController::class, 'getTop5']);

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/notificaciones', [NotificationController::class, 'index'])->name('notificaciones');

Route::get('/perfil1', [UserController::class, 'index'])->name('profile.perfil1');
Route::get('/perfil/puesto_puntos', [UserController::class, 'puesto_puntos'])->name('perfil.puestopuntos');
Route::get('/perfil/detalle', [UserController::class, 'detalle'])->name('perfil.detalle');
Route::post('/perfil/porcentaje-acierto', [UserController::class, 'obtenerPorcentajeAcierto']);
Route::post('/perfil/puntos-por-fecha', [UserController::class, 'obtenerPuntosPorFecha']);

// Rutas de administración
Route::prefix('admin')->middleware(['auth', 'can:admin'])->name('admin.')->group(function () {
    
    // Dashboard principal
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.main');
    
    // Gestión de usuarios
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{id}', [AdminController::class, 'showUser'])->name('users.show');
    Route::put('/users/{id}/permissions', [AdminController::class, 'assignPermissions'])->name('users.permissions');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Gestión de retos
    Route::get('/challenges', [AdminController::class, 'challenges'])->name('challenges');
    Route::get('/challenges/create', [AdminController::class, 'createChallenge'])->name('challenges.create');
    Route::post('/challenges', [AdminController::class, 'storeChallenge'])->name('challenges.store');
    Route::get('/challenges/{id}/edit', [AdminController::class, 'editChallenge'])->name('challenges.edit');
    Route::put('/challenges/{id}', [AdminController::class, 'updateChallenge'])->name('challenges.update');
    Route::delete('/challenges/{id}', [AdminController::class, 'deleteChallenge'])->name('challenges.delete');
    
    // Gestión de categorías
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
    
    // Sistema de notificaciones
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::get('/notifications/create', [AdminController::class, 'createNotification'])->name('notifications.create');
    Route::post('/notifications', [AdminController::class, 'storeNotification'])->name('notifications.store');
    Route::delete('/notifications/{id}', [AdminController::class, 'deleteNotification'])->name('notifications.delete');
    
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

// Mantener la ruta original para compatibilidad
Route::get('/admin', [AdminController::class, 'dashboard'])->middleware('can:admin')->name('admin.dashboard.legacy');




