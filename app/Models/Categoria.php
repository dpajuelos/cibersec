<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'idcategoria';
    protected $fillable = ['nomcategoria'];
    public $timestamps = false;

    // Relación con Retos (1:N)
    public function retos()
    {
        return $this->hasMany(Reto::class, 'fk_categoria');
    }
}
