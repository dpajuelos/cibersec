<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificacionPersona extends Model
{
    use HasFactory;

    protected $table = 'certificaciones_personas';
    protected $primaryKey = 'idcertificaciones_personas';
    public $timestamps = false;

    protected $fillable = [
        'emision_personas',
        'fk_registropersonas'
    ];

    public function registroPersona()
    {
        return $this->belongsTo(RegistroPersona::class, 'fk_registropersonas');
    }
}
