<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juegos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'fk_perfil',
        'fk_reto_pistas',
        'cantidad',
        'tiempo',
        'bandera_enviada',
        'fk_resultado',
        'fk_retos'
    ];
    protected $primaryKey = 'idjuegos'; 

    public function juegos()
    {
        return $this->hasMany(Juegos::class, 'fk_perfil', 'idperfil');
    }
}