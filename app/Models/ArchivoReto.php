<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoReto extends Model
{
    use HasFactory;

    protected $table = 'archivos_reto';
    protected $primaryKey = 'idarchivo';
    public $timestamps = 'false';

    protected $fillable = [
        'nombre',
        'url',
        'tipo',
        'fk_retos'
    ];

    
}
