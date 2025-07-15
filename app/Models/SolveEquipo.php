<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolveEquipo extends Model
{
    use HasFactory;

    protected $table = 'solve_equipos';
    protected $primaryKey = 'idsolve';
    public $timestamps = false;

    protected $fillable = [
        'puntos',
        'time',
        'fk_idsubmissions_teams'
    ];

    public function submission()
    {
        return $this->belongsTo(SubmissionTeam::class, 'fk_idsubmissions_teams');
    }
}
