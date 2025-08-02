<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Perfil;
use App\Models\Reto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;


class PerfilController extends Controller
{
    //
    // Mostrar la vista del perfil del usuario autenticado
   public function Index()
    {
        $usuario = Auth::user()
            ->load([
                'perfil.persona',
                'perfil.nivel',
                'perfil.universidad',
                'roles',
            ]);

        $estado = $usuario->fk_idestados
            ? \App\Models\Estado::find($usuario->fk_idestados)
            : null;

        $perfil = $usuario->perfil;

        // RANKING GENERAL
        $ranking = DB::table('solve_personas')
            ->join('submissions_personas', 'solve_personas.fk_idsubmissions_personas', '=', 'submissions_personas.idsubmissions_personas')
            ->join('registros_personas', 'submissions_personas.fk_idregistros', '=', 'registros_personas.idregistros')
            ->select('registros_personas.fk_perfil', DB::raw('SUM(solve_personas.puntos) as total_puntos'))
            ->groupBy('registros_personas.fk_perfil')
            ->orderByDesc('total_puntos')
            ->get();

        $miPuntaje = 0;
        $miPuesto = null;

        foreach ($ranking as $index => $r) {
            if ($r->fk_perfil == $perfil->idperfil) {
                $miPuntaje = $r->total_puntos;
                $miPuesto = $index + 1;
                break;
            }
        }

        // DATOS EXTRAS

        // Obtener todos los solve_personas del usuario
        $misSolves = DB::table('solve_personas')
            ->join('submissions_personas', 'solve_personas.fk_idsubmissions_personas', '=', 'submissions_personas.idsubmissions_personas')
            ->join('registros_personas', 'submissions_personas.fk_idregistros', '=', 'registros_personas.idregistros')
            ->where('registros_personas.fk_perfil', $perfil->idperfil)
            ->select('solve_personas.puntos', 'submissions_personas.fk_idretos')
            ->get();

        // 1. Cantidad de retos distintos que resolvió
        $cantidadRetos = $misSolves->pluck('fk_idretos')->unique()->count();

        // 2. Número de categorías distintas (requiere tabla retos con fk_categoria)
        $categoriasJugadas = Reto::whereIn('idretos', $misSolves->pluck('fk_idretos')->unique())->pluck('fk_categoria')->unique()->count();

        // 3. Mejor puntuación individual
        $mejorPuntaje = $misSolves->max('puntos');

        $registrosResueltos = DB::table('solve_personas')
        ->join('submissions_personas', 'solve_personas.fk_idsubmissions_personas', '=', 'submissions_personas.idsubmissions_personas')
        ->join('registros_personas', 'submissions_personas.fk_idregistros', '=', 'registros_personas.idregistros')
        ->join('retos', 'submissions_personas.fk_idretos', '=', 'retos.idretos')
        ->join('categorias', 'retos.fk_categoria', '=', 'categorias.idcategoria')
        ->join('estados_reto', 'retos.fk_estado_reto', '=', 'estados_reto.idestado_reto') // Relación al estado del reto
        ->where('registros_personas.fk_perfil', $perfil->idperfil)
        ->select(
            'retos.nomreto as nombre_reto',
            'categorias.nomcategoria',
            'solve_personas.puntos',
            'solve_personas.time',
            'estados_reto.estadoreto as estado_reto'
        )
        ->orderByDesc('solve_personas.puntos')
        ->get();

        // Extrae datos para el gráfico desde los retos resueltos
        $chartData = $registrosResueltos
        ->sortBy('time') // Ordena por tiempo (de menor a mayor)
        ->values()        // Reindexa la colección (para que los índices estén limpios)
        ->map(function($registro) {
            return [
                'nombre' => $registro->nombre_reto,
                'puntos' => $registro->puntos,
                'tiempo' => $registro->time
            ];
        });

        $perfilId = auth()->user()->perfil->idperfil;

        $categoriasData = DB::table('categorias')
            ->join('retos', 'retos.fk_categoria', '=', 'categorias.idcategoria')
            ->join('submissions_personas', 'submissions_personas.fk_idretos', '=', 'retos.idretos')
            ->join('registros_personas', 'submissions_personas.fk_idregistros', '=', 'registros_personas.idregistros')
            ->leftJoin('solve_personas', 'solve_personas.fk_idsubmissions_personas', '=', 'submissions_personas.idsubmissions_personas')
            ->where('registros_personas.fk_perfil', $perfilId)
            ->select(
                'categorias.idcategoria',
                'categorias.nomcategoria',
                DB::raw('COUNT(DISTINCT submissions_personas.idsubmissions_personas) as total_intentos'),
                DB::raw('COUNT(DISTINCT solve_personas.idsolve) as total_resueltos')
            )
            ->groupBy('categorias.idcategoria', 'categorias.nomcategoria')
            ->get();

        // Calcular porcentaje
        $porcentajes = $categoriasData->mapWithKeys(function ($item) {
            $porcentaje = $item->total_intentos > 0
                ? round(($item->total_resueltos / $item->total_intentos) * 100)
                : 0;
            return [$item->idcategoria => $porcentaje];
        });

        return view('profile.perfil1', compact(
            'usuario',
            'estado',
            'miPuntaje',
            'miPuesto',
            'cantidadRetos',
            'categoriasJugadas',
            'mejorPuntaje',
            'registrosResueltos',
            'chartData',
            'categoriasData',
            'porcentajes'
        ));
    }
}
