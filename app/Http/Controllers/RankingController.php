<?php
namespace App\Http\Controllers;

use App\Models\Ranking;
use App\Models\SolvePersona;
use App\Models\Universidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function index()
    {
        $rankings = $this->getRankingData();
        $top3 = $rankings->take(3);

        return view('ranking', compact('rankings', 'top3'));
    }

    public function getTop5()
    {
        $top5 = $this->getRankingData()->take(5);
        return response()->json($top5);
    }

    public function getRankingData()
    {
        $query = User::join('perfiles', 'usuarios.idusuario', '=', 'perfiles.fk_usuario')
            ->join('personas', 'perfiles.fk_persona', '=', 'personas.dni')
            ->join('universidades', 'perfiles.fk_universidad', '=', 'universidades.iduniversidad')
            ->join('registros_personas', 'perfiles.idperfil', '=', 'registros_personas.fk_perfil')
            ->join('competencias', 'registros_personas.fk_competencia', '=', 'competencias.idcompetencia')
            ->join('submissions_personas', 'registros_personas.idregistros', '=', 'submissions_personas.fk_idregistros')
            ->join('solve_personas', 'submissions_personas.idsubmissions_personas', '=', 'solve_personas.fk_idsubmissions_personas')
            ->select(
                'usuarios.usuario as nickname',
                'usuarios.profile_photo_path',
                'universidades.nomuniversidad as universidad',
                DB::raw("CONCAT(personas.nombres, ' ', personas.ape_paterno, ' ', personas.ape_materno) as usuario"),
                DB::raw('SUM(solve_personas.puntos) as total_puntos'),
                DB::raw('ROW_NUMBER() OVER (ORDER BY SUM(solve_personas.puntos) DESC) as puesto')
            )
            ->where('competencias.fk_estado_compe', 3)
            ->groupBy(
                'usuarios.usuario',
                'usuarios.profile_photo_path',
                'universidades.nomuniversidad',
                'personas.nombres',
                'personas.ape_paterno',
                'personas.ape_materno'
            )
            ->orderByDesc(DB::raw('SUM(solve_personas.puntos)'))
            ->get();

        return $query->map(function ($item, $index) {
            return (object) [
                'usuario' => $item->usuario,
                'nickname' => $item->nickname,
                'universidad' => $item->universidad,
                'total_puntos' => (int) $item->total_puntos,
                'puesto' => $index + 1,
                'profile_photo_path' => $item->profile_photo_path,
                'profile_photo_url' => $item->profile_photo_path ? asset('storage/' . $item->profile_photo_path) : asset('images/default-avatar.png')
            ];
        });
    }

    public function getRankingJson()
    {
        $rankings = $this->getRankingData();
        return response()->json($rankings);
    }

    public function categorias()
    {
        $categorias = DB::table('categorias')->select('nomcategoria')->get();
        return response()->json($categorias);
    }
}
