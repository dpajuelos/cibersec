<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'usuarios'; 
    protected $primaryKey = 'idusuario'; 
    public $timestamps = false;
    protected $fillable = [
        'usuario',
        'email',
        'password',
        'fec_registro',
        'fk_estadousuario',
        'foto'
    ];

    protected $hidden = [
        'password',
    ];
    
    function getColorById($id) {
        $red = ($id *50) % 256;    
        $green = ($id * 62) % 256;
        $blue = ($id * 220) % 256;   
        return [$red, $green, $blue];
    }

    public function isActive()
    {
        return $this->fk_estadousuario === 1;
    }
   
    public function updateProfilePhoto($photo): void 
    {
        if ($this->foto) {
            Storage::delete($this->foto);
        }

        $path = $photo->store('profile-photos', 'public');

        $this->forceFill([
            'foto' => $path,
        ])->save();
    }
    
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }else{
            $initials = strtoupper(substr($this->usuario, 0, 1) . substr($this->usuario, 1, 1));
            $width = 100;
            $height = 100;
            $image = imagecreatetruecolor($width, $height);
            list($red, $green, $blue) = $this->getColorById($this->fk_estadousuario);
            $backgroundColor = imagecolorallocate($image, $red, $green, $blue);
            $textColor = imagecolorallocate($image, 0, 0, 0);
            imagefill($image, 0, 0, $backgroundColor);
            $fontSize = 24; 
            $fontPath = public_path('fonts/figtree.ttf');
            $bbox = imagettfbbox($fontSize, 0, $fontPath, $initials);
            $textWidth = $bbox[2] - $bbox[0];
            $textHeight = $bbox[1] - $bbox[7];
            $x = ($width - $textWidth) / 2;
            $y = ($height - $textHeight) / 2 + $textHeight;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $initials);
            $path = 'profile-photos/' . uniqid() . '.png';
            $fullPath = storage_path('app/public/' . $path);
            imagepng($image, $fullPath);
            imagedestroy($image);

            $this->forceFill([
                'foto' => $path,
            ])->save();

            return asset('storage/' . $this->foto);
        }

   
    }

    public function deleteProfilePhoto(): void
    {
        if ($this->foto) {
            Storage::delete($this->foto);
        }

        $this->forceFill([
            'foto' => null,
        ])->save();
    }

    public function updatePassword($password): void
    {
        $this->forceFill([
            'password' => Hash::make($password),
        ])->save();
    }

   

    public function deleteWithRelations()
    {
        DB::transaction(function () {
            $profile = DB::table('perfiles')->where('fk_usuario', $this->idusuario)->first();

            if ($profile) {
                DB::table('perfiles')->where('fk_usuario', $this->idusuario)->delete();
                DB::table('personas')->where('idpersona', $profile->fk_persona)->delete();
            }

            if ($this->foto) {
                $path = public_path($this->foto);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $this->deleteProfilePhoto();
            $this->delete();
        });
    }
}