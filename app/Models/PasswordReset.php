<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_resets';
    protected $primaryKey = 'token';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'issued_at',
        'expires_at',
        'consumed_at',
        'usuarios_idusuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuarios_idusuario');
    }
}
