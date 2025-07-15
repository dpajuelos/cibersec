<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HintlogTeam extends Model
{
    use HasFactory;

    protected $table = 'hintlogs_teams';
    protected $primaryKey = 'idhintlogs_teams';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'fk_idsubmissions_teams',
        'fk_idpistas'
    ];

    public function submission()
    {
        return $this->belongsTo(SubmissionTeam::class, 'fk_idsubmissions_teams');
    }

    public function pista()
    {
        return $this->belongsTo(Pista::class, 'fk_idpistas');
    }
}
