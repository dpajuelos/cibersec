<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Support\Facades\Hash;

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
        'profile_photo_path',
        'fk_idestados'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'fk_idestados', 'idestados');
    }

    public function perfiles()
    {
        return $this->hasMany(Perfil::class, 'fk_usuario');
    }

    public function isActive()
    {
        return true; // o alguna lógica como: return $this->estado === 'activo';
    }
    public function getAuthIdentifierName()
    {
        return 'idusuario'; 
    }
    public function updatePassword(string $newPassword): bool
    {
        $this->password = Hash::make($newPassword);
        return $this->save();
    }
}
