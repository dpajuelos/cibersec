<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionPersona extends Model
{
    use HasFactory;

    protected $table = 'submissions_personas';
    protected $primaryKey = 'idsubmissions_personas';
    public $timestamps = false;

    protected $fillable = [
        'flag_enviada',
        'fecha',
        'correcto',
        'fk_idregistros',
        'fk_idretos'
    ];

    public function registro()
    {
        return $this->belongsTo(RegistroPersona::class, 'fk_idregistros');
    }

    public function reto()
    {
        return $this->belongsTo(Reto::class, 'fk_idretos');
    }
}
