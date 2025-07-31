<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HitlogPersona extends Model
{
    use HasFactory;

    protected $table = 'hitlog_personas';
    protected $primaryKey = 'idhitlog_personas';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'fk_idregistros',
        'fk_idpistas'
    ];

    public function registro()
    {
        return $this->belongsTo(RegistroPersona::class, 'fk_idregistros');
    }

    public function pista()
    {
        return $this->belongsTo(Pista::class, 'fk_idpistas');
    }
}
