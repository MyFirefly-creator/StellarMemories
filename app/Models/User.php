<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;




    protected $fillable = [
        'Username',
        'email',
        'password',
        'NamaLengkap',
        'Alamat',
        'image',
        'role',
        'google_id',
        'google_token',
        'google_refresh_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class, 'UserID', 'id');
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'UserID', 'id');
    }

    public function komentarFotos()
    {
        return $this->hasMany(KomentarFoto::class, 'UserID', 'id');
    }

    public function likeFotos()
    {
        return $this->hasMany(LikeFoto::class, 'UserID', 'id');
    }

    public function warnings()
    {
        return $this->hasMany(Warning::class, 'UserID');
    }

    public function banned()
    {
       return $this->hasOne(Ban::class, 'UserID')->where('Ban_Until', '>', now());
    }
}
