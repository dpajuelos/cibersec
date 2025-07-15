<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'idroles';
    protected $fillable = ['namerol'];
    public $timestamps = 'false';

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuarios_has_roles', 'roles_idroles', 'usuarios_idusuario');
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'roles_has_permiisos', 'idroles', 'idpermiisos');
    }
}
