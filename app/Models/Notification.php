<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fk_idusuario',
        'message',
        'is_read',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    // (Opcional) Relación con Usuario si existe
    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_idusuario');
    }
}
