<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\HasProfilePhoto;

class User extends Authenticatable
{
    use HasFactory;
    use HasProfilePhoto;

    protected $table = 'usuarios';
    protected $primaryKey = 'idusuario';
    public $timestamps = false;

    protected $fillable = [
        'usuario',
        'email',
        'password',
        'fec_registro',
        'fk_idestados',
        'profile_photo_path'
    ];

    public function perfiles()
    {
        return $this->hasMany(Perfil::class, 'fk_usuario');
    }

    public function isActive()
    {
        return true;
    }

    public function getAuthIdentifierName()
    {
        return 'idusuario';
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return Storage::url($this->profile_photo_path);
        }
    }

    /**
     * Eliminar usuario con todas sus relaciones
     */
    public function deleteWithRelations()
    {
        // Eliminar la foto de perfil del storage si existe
        if ($this->profile_photo_path) {
            Storage::disk('public')->delete($this->profile_photo_path);
        }

        $dniPersonas = $this->perfiles()->pluck('fk_persona')->toArray();

        // Eliminar perfiles
        $this->perfiles()->delete();

        // Eliminar personas por DNI
        if (!empty($dniPersonas)) {
            \App\Models\Persona::whereIn('dni', $dniPersonas)->delete();
        }

        // Eliminar el usuario
        $this->delete();
    }
}
