<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomentarFoto;
use App\Models\Foto;

class KomentarController extends Controller
{
    public function index($id)
    {
        $foto = Foto::with(['user', 'komentarfotos.user'])->find($id);

        if (!$foto) {
            return redirect()->route('foto.index')->with('error', 'Foto tidak ditemukan.');
        }

        return view('foto.show', compact('foto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'IsiKomentar' => 'required|string|max:255',
            'FotoID' => 'required|exists:fotos,id',
        ]);

        KomentarFoto::create([
            'FotoID' => $request->FotoID,
            'UserID' => auth()->id(),
            'IsiKomentar' => $request->IsiKomentar,
            'TanggalKomentar' => now(),
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
