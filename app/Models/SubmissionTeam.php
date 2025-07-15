<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionTeam extends Model
{
    use HasFactory;

    protected $table = 'submissions_teams';
    protected $primaryKey = 'idsubmissions_teams';
    public $timestamps = false;

    protected $fillable = [
        'flag_enviada',
        'fecha',
        'correcto',
        'fk_idregistros_equipos',
        'fk_idretos'
    ];

    public function registroEquipo()
    {
        return $this->belongsTo(RegistroEquipo::class, 'fk_idregistros_equipos');
    }

    public function reto()
    {
        return $this->belongsTo(Reto::class, 'fk_idretos');
    }
}
