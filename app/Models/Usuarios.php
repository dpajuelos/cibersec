<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    protected $primaryKey = 'idusuario';
    public $timestamps = false;
    protected $fillable = [
        'usuario',
        'email',
        'password',
        'fec_registro',
        'fk_estadousuario',
        'foto'
    ];
   
}