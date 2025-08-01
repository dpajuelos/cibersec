<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCompetencia extends Model
{
    use HasFactory;

    protected $table = 'estados_compe';
    protected $primaryKey = 'idestado_compe';
    protected $fillable = ['estadocompe'];
    public $timestamps = false;

    public function competencias()
    {
        return $this->hasMany(Competencia::class, 'fk_estado_compe');
    }
}
