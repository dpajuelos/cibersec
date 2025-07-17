<?php

// app/Models/Reto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reto extends Model
{
    use HasFactory;

    protected $table = 'retos';
    protected $primaryKey = 'idretos';
    public $timestamps = false;

    protected $fillable = [
        'puntos',
        'nomreto',
        'descripcion',
        'flag',
        'fk_categoria',
        'fk_nivel',
        'fk_competencia',
        'fk_estado_reto',
    ];

    // Relación con Categoría (N:1)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'fk_categoria');
    }

    // Relación con NivelReto (N:1)
    public function nivel()
    {
        return $this->belongsTo(NivelReto::class, 'fk_nivel');
    }

    // Relación con Competencia (N:1)
    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'fk_competencia');
    }

    // Relación con EstadoReto (N:1)
    public function estadoReto()
    {
        return $this->belongsTo(EstadoReto::class, 'fk_estado_reto');
    }

    public function archivo()
    {
        return $this->belongsTo(ArchivoReto::class, 'fk_archivo', 'idarchivo');
    }

    // Relación con Pistas (N:M) (usando tabla pivote retos_has_pistas)
    public function pistas()
    {
        return $this->belongsToMany(Pista::class, 'retos_has_pistas', 'idretos', 'idpistas');
    }
}
