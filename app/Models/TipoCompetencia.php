<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCompetencia extends Model
{
    use HasFactory;

    protected $table = 'tipos_compe';
    protected $primaryKey = 'idtipo_compe';
    protected $fillable = ['tipocompe'];
    public $timestamps = false;

    public function competencias()
    {
        return $this->hasMany(Competencia::class, 'fk_tipo_compe');
    }
}
