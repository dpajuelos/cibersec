<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Ranking;
use Illuminate\Support\Facades\DB;
class RankingController extends Controller
{
    //
    public function index()
    {
        $rankings = Ranking::all(); 
        
        return view('ranking', compact('rankings')); 
        
    }
    public function getTop5()
    {
        $top5 = Ranking::orderBy('total_puntos', 'desc')
                    ->limit(5)
                    ->get();
        return response()->json($top5);
    }
    public function categorias()
    {
        $categorias = DB::table('categorias')->select('nomcategoria')->get();
        return response()->json($categorias);
    }
}