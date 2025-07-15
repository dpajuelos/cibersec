<?php

// app/Models/Perfil.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfiles';
    protected $primaryKey = 'idperfil';
    public $timestamps = false;

    protected $fillable = [
        'biografia',
        'link',
        'fk_usuario',
        'fk_nivel',
        'fk_universidad',
        'fk_persona'
    ];

    // Relación con Persona (1:1 inversa)
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'fk_persona', 'dni');
    }

    // Relación con Universidad (N:1)
    public function universidad()
    {
        return $this->belongsTo(Universidad::class, 'fk_universidad');
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'fk_nivel');
    }

    // Relación con User (Laravel default)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_usuario', 'idusuario');
    }
}
