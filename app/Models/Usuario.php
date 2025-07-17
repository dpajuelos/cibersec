<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'idusuario';
    public $timestamps = false;

    protected $fillable = [
        'usuario',
        'email',
        'password',
        'fec_registro',
        'foto'
    ];

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
    
}
