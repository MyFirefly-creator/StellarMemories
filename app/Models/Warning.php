<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function foto()
    {
        return $this->belongsTo(Foto::class, 'FotoID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
