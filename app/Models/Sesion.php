<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    protected $table = 'sesiones';
    protected $primaryKey = 'idsesiones';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ip_address',
        'created_at',
        'expires_at',
        'fk_idusuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_idusuario');
    }
}
