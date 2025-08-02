<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Persona;
use App\Rules\EmailEduPe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    /**
     * Mostrar la vista de gestión de usuarios
     */
    public function index(Request $request)
    {
        // Obtener usuarios con sus relaciones
        $usuarios = User::with([
            'roles',
            'perfil.persona',
            'perfil.universidad',
            'perfil.nivel'
        ])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q
                        ->where('usuario', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('perfil.persona', function ($subQuery) use ($search) {
                            $subQuery
                                ->where('nombres', 'like', "%{$search}%")
                                ->orWhere('ape_paterno', 'like', "%{$search}%")
                                ->orWhere('ape_materno', 'like', "%{$search}%");
                        });
                });
            })
            ->when($request->estado, function ($query, $estado) {
                $query->where('fk_idestados', $estado);
            })
            ->when($request->rol, function ($query, $rol) {
                $query->whereHas('roles', function ($subQuery) use ($rol) {
                    $subQuery->where('roles.idroles', $rol);
                });
            })
            ->orderBy('fec_registro', 'desc')
            ->paginate(10)
            ->appends($request->query());

        // Obtener estados para el filtro
        $estados = Estado::all();

        // Obtener roles para el filtro
        $roles = Rol::all();

        return view('admin.a-usuarios', compact('usuarios', 'estados', 'roles'));
    }

    /**
     * Mostrar detalles de un usuario específico
     */
    public function show($id)
    {
        $usuario = User::with([
            'roles',
            'perfil.persona',
            'perfil.universidad',
            'perfil.nivel'
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'usuario' => $usuario
        ]);
    }

    // LOGICA PARA REGISTRAR USUARIOS POR EL ADMIN
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
            'rol' => 'required|integer|exists:roles,idroles',
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

            // Generar imagen de perfil
            $profilePhotoPath = $this->generateProfileImage($request->usuario);

            // Crear usuario
            $usuario = User::create([
                'usuario' => $request->usuario,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'fec_registro' => now(),
                'fk_idestados' => 1,
                'profile_photo_path' => $profilePhotoPath,
            ]);
            
            // Asignar rol por defecto (por ejemplo, id = 2)
            $usuario->roles()->attach([
                $request->rol => ['fecha' => now()]
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

    private function generateProfileImage($usuario)
    {
        // Crear directorio si no existe
        $directory = storage_path('app/public/profile-photos');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Colores de fondo aleatorios (20 opciones)
        $backgroundColors = [
            [255, 107, 107], [78, 205, 196], [69, 183, 209], [150, 206, 180], [254, 202, 87],
            [255, 159, 243], [84, 160, 255], [95, 39, 205], [0, 210, 211], [255, 159, 67],
            [16, 172, 132], [238, 90, 36], [9, 132, 227], [108, 92, 231], [253, 121, 168],
            [253, 203, 110], [225, 112, 85], [129, 236, 236], [116, 185, 255], [162, 155, 254]
        ];

        // Seleccionar color aleatorio
        $backgroundColor = $backgroundColors[array_rand($backgroundColors)];

        // Obtener las dos primeras letras del usuario
        $initials = strtoupper(substr($usuario, 0, 2));

        // Generar nombre único para la imagen
        $fileName = Str::random(40) . '.png';

        $filePath = 'profile-photos/' . $fileName;
        $fullPath = storage_path('app/public/' . $filePath);

        // Crear imagen con GD
        $img = imagecreatetruecolor(200, 200);

        // Definir color de fondo
        $bgColor = imagecolorallocate($img, $backgroundColor[0], $backgroundColor[1], $backgroundColor[2]);

        // Color del texto (blanco)
        $textColor = imagecolorallocate($img, 255, 255, 255);

        // Rellenar fondo
        imagefill($img, 0, 0, $bgColor);

        // Configuración del texto con fuente TTF
        $fontSize = 48;

        // Usar una fuente del sistema o una por defecto
        $fontPath = public_path('fonts/figtree.ttf');

        // Calcular dimensiones del texto
        $textBox = imagettfbbox($fontSize, 0, $fontPath, $initials);
        $textWidth = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[7] - $textBox[1]);

        // Calcular posición centrada
        $x = (200 - $textWidth) / 2;
        $y = (200 / 2) + ($textHeight / 2);

        imagettftext($img, $fontSize, 0, $x, $y, $textColor, $fontPath, $initials);

        // Guardar imagen como PNG
        imagepng($img, $fullPath);

        imagedestroy($img);

        return $filePath;
    }

    public function universidades()
    {
        $universidades = DB::table('universidades')
            ->select('iduniversidad', 'nomuniversidad')
            ->orderBy('iduniversidad')
            ->get();
        return response()->json($universidades);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'usuario' => ['required', 'string', 'max:16', Rule::unique('usuarios', 'usuario')->ignore($id, 'idusuario')],
            'paterno' => 'required|string|max:30',
            'materno' => 'required|string|max:30',
            'dni' => 'required|string|size:8|exists:personas,dni',
            'fecnac' => 'required|date|before:today',
            'genero' => 'required|string|in:Masculino,Femenino,Otro',
            'email' => ['required', 'email', Rule::unique('usuarios', 'email')->ignore($id, 'idusuario')],
            'celular' => 'required|string|size:9',
            'universidad' => 'required|integer|exists:universidades,iduniversidad',
            'rol' => 'required|integer|exists:roles,idroles',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $usuario = User::with('perfil.persona')->findOrFail($id);
            if (!$usuario->perfil || !$usuario->perfil->persona) {
                return response()->json(['message' => 'Perfil o persona no encontrados para este usuario.'], 404);
            }

            // Actualizar persona
            $usuario->perfil->persona->update([
                'nombres' => $request->name,
                'ape_paterno' => $request->paterno,
                'ape_materno' => $request->materno,
                'fec_nacimiento' => $request->fecnac,
                'genero' => $request->genero,
                'celular' => $request->celular,
            ]);

            // Actualizar usuario
           $usuario->update([
                'usuario' => $request->usuario,
                'email' => $request->email
                
            ]);
            if ($request->filled('password')) {
                    $usuario->password = Hash::make($request->password);
                    $usuario->save();
                }

            // Actualizar perfil
            $usuario->perfil->update([
                'fk_universidad' => $request->universidad,
            ]);

            // Actualizar rol (eliminando roles previos y asignando el nuevo)
            $usuario->roles()->syncWithPivotValues(
                [$request->rol],
                ['fecha' => now()]
            );

            DB::commit();

            return response()->json(['message' => 'Usuario actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al actualizar usuario: ' . $e->getMessage());
            return response()->json(['message' => 'Error al actualizar usuario'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $usuario = User::with('perfil.persona')->findOrFail($id);

            // 1. Eliminar relación con roles (tabla intermedia)
            $usuario->roles()->detach();

            // 2. Eliminar perfil y luego persona
            if ($usuario->perfil) {
                $perfil = $usuario->perfil;

                // Guardar DNI para borrar persona después
                $dni = $perfil->fk_persona;

                // Eliminar perfil primero (porque hace referencia a persona)
                $perfil->delete();

                // Luego eliminar persona (ya no hay perfil que la referencie)
                \App\Models\Persona::where('dni', $dni)->delete();
            }

            // 3. Eliminar usuario
            $usuario->delete();

            DB::commit();
            return response()->json(['message' => 'Usuario eliminado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al eliminar usuario: ' . $e->getMessage());
            return response()->json(['message' => 'Error al eliminar usuario'], 500);
        }
    }

    public function cambiarEstado($id)
    {
        try {
            $usuario = \App\Models\User::findOrFail($id);

            // Suponiendo que 1 = Activo, 2 = Inactivo (ajústalo según tus valores)
            $usuario->fk_idestados = $usuario->fk_idestados == 1 ? 2 : 1;
            $usuario->save();

            return response()->json([
                'message' => 'Estado actualizado correctamente',
                'nuevo_estado' => $usuario->fk_idestados
            ]);
        } catch (\Exception $e) {
            \Log::error("Error al cambiar estado del usuario: " . $e->getMessage());
            return response()->json(['message' => 'Error al cambiar el estado'], 500);
        }
    }


}
