<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataGaleri = Album::orderBy('id', 'asc')->paginate(10);
        return view('album.index', compact('dataGaleri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('album.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NamaAlbum' => 'required|string|max:255',
            'Deskripsi' => 'required|string',
            'TanggalDibuat' => 'required|date'
        ]);

        Album::create([
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
            'TanggalDibuat' => $request->TanggalDibuat,
            'UserID' => Auth::id(),
        ]);

        return redirect()->route('album.index')->with('success', 'Album berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $album = Album::findOrFail($id);

        if ($album->UserID !== Auth::id()) {
            return redirect()->route('album.index')->with('error', 'Anda tidak memiliki akses untuk mengedit album ini.');
        }

        return view('album.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'NamaAlbum' => 'required|string|max:255',
            'Deskripsi' => 'required|string',
            'TanggalDibuat' => 'required|date'
        ]);

        $album = Album::findOrFail($id);

        if ($album->UserID !== Auth::id()) {
            return redirect()->route('album.index')->with('error', 'Anda tidak memiliki akses untuk mengedit album ini.');
        }

        $album->update([
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
            'TanggalDibuat' => $request->TanggalDibuat,
        ]);

        return redirect()->route('album.index')->with('success','Album Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id);

        if ($album->UserID !== Auth::id()) {
            return redirect()->route('album.index')->with('error', 'Anda tidak memiliki akses untuk menghapus album ini.');
        }

        $album->delete();

        return redirect()->route('album.index')->with('success', 'Album berhasil dihapus!');
    }
}
