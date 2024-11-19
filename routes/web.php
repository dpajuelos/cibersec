<?php
use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

use App\Http\Controllers\RetosController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;

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

Route::get('/retos', [RetosController::class, 'index'])->name('retos');

Route::get('/detalles/{id}', [RetosController::class, 'detalles']);

Route::middleware(['auth'])->group(function () {

    Route::get('/resueltos/{id}', [RetosController::class, 'obtenerResueltos']);

    Route::get('/retos/{idretos}/pistas', [RetosController::class, 'obtenerPistas']);
});

Route::post('/RegistroPistas', [RetosController::class, 'RegistroPistas']);

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

Route::get('/perfil1', function () {
    return view('profile.perfil1');
})->name('profile.perfil1');



