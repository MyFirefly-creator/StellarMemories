<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function album()
    {
        return $this->belongsTo(Album::class, 'AlbumID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function komentarFotos()
    {
        return $this->hasMany(KomentarFoto::class, 'FotoID');
    }

    public function likeFotos()
    {
        return $this->hasMany(LikeFoto::class, 'FotoID');
    }

    public function isLikedBy($userId)
    {
        return $this->likeFotos()->where('UserID', $userId)->exists();
    }
}
