<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class v_usuarios extends Model
{
    protected $table = 'v_usuarios'; 
    public $timestamps = false;
     public function getProfilePhotoUrlAttribute()
     {
        return asset('storage/' . $this->foto);
     }
}
