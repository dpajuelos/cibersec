<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perfiles extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'biografia',
        'link',
        'fk_usuario',
        'fk_nivel',
        'fk_universidad',
        'fk_certificaciones',
        'fk_persona',
    ];
    protected $primaryKey = 'idperfil';
}