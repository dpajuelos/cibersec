<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelReto extends Model
{
    use HasFactory;

    protected $table = 'niveles_reto';
    protected $primaryKey = 'idnivel_reto';
    protected $fillable = ['nomnivelreto'];
    public $timestamps = false;

    public function retos()
    {
        return $this->hasMany(Reto::class, 'fk_nivel');
    }
}
