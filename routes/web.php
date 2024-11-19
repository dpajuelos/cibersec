<?php
use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

use App\Http\Controllers\RetosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuario', function () {
    return view('usuario'); 
})->name('usuario');

Route::get('/ranking', function () {
    return view('ranking'); 
});

Route::get('/retos', [RetosController::class, 'index'])->name('retos');

Route::get('/detalles/{id}', [RetosController::class, 'detalles']);

Route::get('/retos/{idretos}/pistas', [RetosController::class, 'obtenerPistas']);

Route::get('/usuario', [UsuariosController::class, 'index']);

Route::get('/usuario/buscar', [UsuariosController::class, 'buscarusuario'])->name('usuarios.buscar');

Route::get('/usuario/filtrar', [UsuariosController::class, 'filtrarusuarios'])->name('usuarios.filtrar');

Route::get('/usuario/ordenar', [UsuariosController::class, 'ordenarusuarios'])->name('usuarios.ordenar');

Route::get('/categorias', [RankingController::class, 'categorias']);

Route::get('/usuarios/puesto_puntos', [UsuariosController::class, 'puesto_puntos'])->name('usuarios.puestopunto');

Route::get('/usuarios/detalle', [UsuariosController::class, 'detalle'])->name('usuarios.detalle');

Route::post('/usuarios/porcentaje-acierto', [UsuariosController::class, 'obtenerPorcentajeAcierto']);

Route::post('/usuarios/puntos-por-fecha', [UsuariosController::class, 'obtenerPuntosPorFecha']);

Route::get('/ranking', [RankingController::class, 'index']);

Route::get('/rankings/top5', [RankingController::class, 'getTop5']);


Route::get('/perfil1', function () {
    return view('profile.perfil1');
})->name('profile.perfil1');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
});