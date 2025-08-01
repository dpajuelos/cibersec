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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
}
