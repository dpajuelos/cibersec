<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pista extends Model
{
    use HasFactory;

    protected $table = 'pistas';
    protected $primaryKey = 'idpistas';
    public $timestamps = false;

    protected $fillable = [
        'contenido',
        'valor'
    ];

    // Relación con Retos (N:M)
    public function retos()
    {
        return $this->belongsToMany(Reto::class, 'retos_has_pistas', 'idpistas', 'idretos');
    }
}
