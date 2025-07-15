<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';
    protected $primaryKey = 'idequipos';
    public $timestamps = false;

    protected $fillable = [
        'nomequipo',
        'descripción',
        'foto',
        'fec_creacion'
    ];

    public function miembros()
    {
        return $this->hasMany(MiembroEquipo::class, 'fk_equipos');
    }

    public function registrosCompetencias()
    {
        return $this->hasMany(RegistroEquipo::class, 'fk_equipo');
    }
}
