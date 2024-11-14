<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Usuarios extends Model
{
    //
    // Definir la tabla como una vista
    protected $table = 'v_usuarios'; // El nombre de la vista
    public $timestamps = false; // Si la vista no tiene campos de timestamps
     // Método para obtener la foto como base64
     public function getFotoAttribute($value)
     {
         if ($value) {
             return 'data:image/jpeg;base64,' . base64_encode($value);
         }
         return asset('https://scontent.fchm1-1.fna.fbcdn.net/v/t39.30808-6/441533127_122104779176306008_7134778851634272522_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeHibqpiGc4-MC_thP6-_nZX1HBvtqmyElrUcG-2qbISWmd4-EtCSKySXEhZdiM3pZgQt2xsCrSnllI9rD1Wdj2F&_nc_ohc=foY4s1tpgwMQ7kNvgHA_gr3&_nc_zt=23&_nc_ht=scontent.fchm1-1.fna&_nc_gid=AC0veTzVyfUs40riiq6wlTQ&oh=00_AYDPE9VO3NYJgBrZaFmb9DVZ3RfAO9IkvPo-0nRcDDiEMw&oe=6729F6E3');
     }
}