<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    use HasFactory;

    protected $table = 'universidades';
    protected $primaryKey = 'iduniversidad';
    public $timestamps = false;

    protected $fillable = [
        'nomuniversidad',
        'fk_ciudad'
    ];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'fk_ciudad');
    }

    public function perfiles()
    {
        return $this->hasMany(Perfil::class, 'fk_universidad');
    }
}
