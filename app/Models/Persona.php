<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';
    protected $primaryKey = 'dni';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'dni',
        'nombres',
        'ape_paterno',
        'ape_materno',
        'fec_nacimiento',
        'genero',
        'celular'
    ];

    protected $keyType = 'string';

    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'fk_persona');
    }
}
