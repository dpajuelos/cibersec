<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Persona;
use App\Models\User;
use App\Rules\EmailEduPe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'usuario' => 'required|string|max:16|unique:usuarios,usuario',
            'paterno' => 'required|string|max:30',
            'materno' => 'required|string|max:30',
            'dni' => 'required|string|size:8|unique:personas,dni',
            'fecnac' => 'required|date|before:today',
            'genero' => 'required|string|in:Masculino,Femenino,Otro',
            'email' => ['required', 'email', 'unique:usuarios,email', new EmailEduPe],
            'password' => 'required|string|min:8|confirmed',
            'celular' => 'required|string|size:9',
            'universidad' => 'required|integer|exists:universidades,iduniversidad',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            // Crear persona primero
            $persona = Persona::create([
                'dni' => $request->dni,
                'nombres' => $request->name,
                'ape_paterno' => $request->paterno,
                'ape_materno' => $request->materno,
                'fec_nacimiento' => $request->fecnac,
                'genero' => $request->genero,
                'celular' => $request->celular,
            ]);

            // Crear usuario
            $usuario = User::create([
                'usuario' => $request->usuario,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'fec_registro' => now(),
                'fk_idestados' => 1,
            ]);

            // Crear perfil relacionando persona y usuario
            Perfil::create([
                'fk_persona' => $persona->dni,
                'fk_usuario' => $usuario->idusuario,
                'fk_universidad' => $request->universidad,
                'fk_nivel' => 1,
            ]);

            DB::commit();

            Auth::login($usuario);
            return response()->json(['message' => 'Registro exitoso'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error en registro: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error al registrar usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    public function universidades()
    {
        $universidades = DB::table('universidades')
            ->select('iduniversidad', 'nomuniversidad')
            ->orderBy('iduniversidad')
            ->get();
        return response()->json($universidades);
    }
}
