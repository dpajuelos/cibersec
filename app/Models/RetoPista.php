<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetoPista extends Pivot
{
    protected $table = 'retos_has_pistas';
    public $timestamps = false;
}
