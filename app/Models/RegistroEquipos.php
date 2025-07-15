<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEquipo extends Model
{
    use HasFactory;

    protected $table = 'registros_equipos';
    protected $primaryKey = 'idregistros_equipos';
    public $timestamps = false;

    protected $fillable = [
        'fec_registro',
        'fk_equipo',
        'fk_competencia'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'fk_equipo');
    }

    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'fk_competencia');
    }

    public function submissions()
    {
        return $this->hasMany(SubmissionTeam::class, 'fk_idregistros_equipos');
    }
}
