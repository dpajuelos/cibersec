<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiembroEquipo extends Model
{
    use HasFactory;

    protected $table = 'miembros_equipos';
    protected $primaryKey = 'idmiembros';
    public $timestamps = false;

    protected $fillable = [
        'rol',
        'fec_union',
        'fk_equipos',
        'fk_perfil'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'fk_equipos');
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'fk_perfil');
    }
}
