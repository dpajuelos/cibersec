<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'niveles';
    protected $primaryKey = 'idnivel';
    protected $fillable = ['nomnivel'];
    public $timestamps = false;

    // Relación con Perfiles (1:N)
    public function perfiles()
    {
        return $this->hasMany(Perfil::class, 'fk_nivel');
    }
};
