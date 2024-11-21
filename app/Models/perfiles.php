<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perfiles extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idperfil';

    protected $fillable = [
        'fk_usuario',
        'fk_nivel',
        'fk_universidad',
        'fk_persona',
    ];


}