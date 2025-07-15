<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
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
}
