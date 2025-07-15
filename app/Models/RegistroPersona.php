<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroPersona extends Model
{
    use HasFactory;

    protected $table = 'registros_personas';
    protected $primaryKey = 'idregistros';
    public $timestamps = false;

    protected $fillable = [
        'fec_registro',
        'fk_perfil',
        'fk_competencia'
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'fk_perfil');
    }

    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'fk_competencia');
    }

    public function submissions()
    {
        return $this->hasMany(SubmissionPersona::class, 'fk_idregistros');
    }

    public function certificaciones_persona()
    {
        return $this->hasMany(CertificacionPersona::class, 'fk_idregistros');
    }
}
