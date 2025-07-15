<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';
    protected $primaryKey = 'idciudad';
    public $timestamps = false;

    protected $fillable = [
        'nomciudad'
    ];

    public function universidades()
    {
        return $this->hasMany(Universidad::class, 'fk_ciudad');
    }
}
