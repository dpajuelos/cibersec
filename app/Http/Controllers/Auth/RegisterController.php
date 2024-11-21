<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\personas;
use App\Models\perfiles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Rules\EmailEduPe;

class RegisterController extends Controller
{
    public function register(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'usuario' => 'required|string|max:16|unique:usuarios,usuario',
        'paterno' => 'required|string|max:30',
        'materno' => 'required|string|max:30',
        'dni' => 'required|string|max:8|unique:personas,dni',
        'fecnac' => 'required|date',
        'genero' => 'required|string',
        'email' => ['required','unique:usuarios,email', new EmailEduPe],
        'password' => 'required|string|min:8|confirmed',
        'celular' => 'required|string|max:9',
        'universidad' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    } else {
        $persona = Personas::create([
            'nombres' => $request->name,
            'ape_paterno' => $request->paterno,
            'ape_materno' => $request->materno,
            'dni' => $request->dni,
            'fec_nacimiento' => $request->fecnac,
            'genero' => $request->genero,
            'celular' => $request->celular,
        ]);
    
        $usuario = User::create([
            'usuario' => $request->usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fec_registro' => now(),
            'fk_estadousuario' => 1,
        ]);
    
        Perfiles::create([
            'fk_persona' => $persona->idpersona,
            'fk_usuario' => $usuario->idusuario,
            'fk_universidad' => $request->universidad,
            'fk_nivel'  => 1,
        ]);
        
        Auth::login($usuario);
        return response()->json(['message' => 'Registro exitoso']);
    }
    }

    public function universidades()
    {
        $universidades = DB::table('universidades')->select('iduniversidad','nomuniversidad')->orderby('iduniversidad')->get();
        return response()->json($universidades);
    }
    

}