<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'idpersona',
        'nombres',
        'ape_paterno',
        'ape_materno',
        'dni',
        'fec_nacimiento',
        'genero',
        'celular', 
    ];
    protected $primaryKey = 'idpersona';
}