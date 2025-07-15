<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolvePersona extends Model
{
    use HasFactory;

    protected $table = 'solve_personas';
    protected $primaryKey = 'idsolve';
    public $timestamps = 'false';

    protected $fillable = [
        'puntos',
        'time',
        'fk_idsubmissions_personas'
    ];

    public function submission()
    {
        return $this->belongsTo(SubmissionPersona::class, 'fk_idsubmissions_personas');
    }
}
