<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juegos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idjuegos';
    protected $fillable = [
        'cantidad',
        'tiempo',
        'bandera_enviada',
        'fk_perfil',
        'fk_resultado',
        'fk_retos',
        'fk_reto_pistas'
    ];


}