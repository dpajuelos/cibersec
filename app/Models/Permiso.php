<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permiisos';
    protected $primaryKey = 'idpermisos';
    protected $fillable = ['namepermiso'];
    public $timestamps = 'false';

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'roles_has_permisos', 'idpermisos', 'idroles');
    }
}
