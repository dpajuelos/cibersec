<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificacionTeam extends Model
{
    use HasFactory;

    protected $table = 'certificaciones_teams';
    protected $primaryKey = 'idcertificaciones_teams';
    public $timestamps = false;

    protected $fillable = [
        'emision_teams',
        'fk_registroteams'
    ];

    public function registroEquipo()
    {
        return $this->belongsTo(RegistroEquipo::class, 'fk_registroteams');
    }
}
