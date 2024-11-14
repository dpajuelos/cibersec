<?php

namespace App\Http\Controllers;

use App\Models\Retos;
use App\Models\Pistas;
use Illuminate\Http\Request;

class RetosController extends Controller
{
    public function index()
    {

        $retos = Retos::all();

        $retosPorCategoria = $retos->groupBy('nomcategoria');

        return view('retos', compact('retosPorCategoria'));
    }

    public function detalles($id)
    {
        $detalle = Retos::find($id);

        if ($detalle) {
            return response()->json($detalle);
        }

        return response()->json(['error' => 'Reto no encontrado'], 404);
    }

    public function obtenerPistas($idretos)
    {
        $pistas = Pistas::select('valor', 'contenido')
            ->join('reto_pistas as rp', 'rp.fk_pistas', '=', 'idpistas')
            ->join('retos as r', 'rp.fk_retos', '=', 'r.idretos')
            ->where('rp.fk_retos', $idretos)
            ->get();

        return response()->json($pistas);
    }
}