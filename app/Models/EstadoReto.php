<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoReto extends Model
{
    use HasFactory;

    protected $table = 'estados_reto';
    protected $primaryKey = 'idestado_reto';
    protected $fillable = ['estadoreto'];
    public $timestamps = false;

    public function retos()
    {
        return $this->hasMany(Reto::class, 'fk_estado_reto', 'idestado_reto');
    }
}
