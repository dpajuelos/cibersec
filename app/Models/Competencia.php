<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    use HasFactory;

    protected $table = 'competencias';
    protected $primaryKey = 'idcompetencia';
    public $timestamps = false;

    protected $fillable = [
        'nomcompe',
        'descripcion',
        'fec_inicio',
        'fec_final',
        'fk_estado_compe',
        'fk_tipo_compe'
    ];

    public function estado()
    {
        return $this->belongsTo(EstadoCompetencia::class, 'fk_estado_compe');
    }

    public function tipo()
    {
        return $this->belongsTo(TipoCompetencia::class, 'fk_tipo_compe');
    }

    public function retos()
    {
        return $this->hasMany(Reto::class, 'fk_competencia');
    }
}
