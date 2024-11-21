<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class soluciones extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'soluciones';
    protected $primaryKey = 'idsoluciones';
}
