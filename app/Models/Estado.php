<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
     use HasFactory;

    protected $table = 'estados';
    protected $primaryKey = 'idestados';
    public $timestamps = false;

    protected $fillable = [
        'name_state',
    ];

    // Relación con usuarios
    public function usuarios()
    {
        return $this->hasMany(User::class, 'fk_idestados', 'idestados');
    }
}
