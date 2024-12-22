<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\LikeFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeFotoController extends Controller
{
    public function toggleLike($fotoId)
    {
        $foto = Foto::find($fotoId);
        if (!$foto) {
            return redirect()->back()->with('error', 'Foto tidak ditemukan.');
        }

        $userId = Auth::id();
        $like = LikeFoto::where('FotoID', $fotoId)->where('UserID', $userId)->first();

        if ($like) {
            $like->delete();
        } else {
            LikeFoto::create([
                'FotoID' => $fotoId,
                'UserID' => $userId,
                'TanggalLike' => now()
            ]);
        }

        return redirect()->back();
    }
}
