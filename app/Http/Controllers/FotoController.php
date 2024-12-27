<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FotoController extends Controller
{
    public function index()
    {
        $dataFoto = Foto::where('UserID', Auth::id())->orderBy('id', 'asc')->paginate(10);
        return view('foto.index', compact('dataFoto'));
    }

    public function create()
    {
        $albums = Album::all();
        return view('foto.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'JudulFoto' => 'required|string|max:255',
            'DeskripsiFoto' => 'required|string',
            'TanggalUnggah' => 'required|date',
            'LokasiFoto' => 'required|string',
            'AlbumID' => 'required|exists:albums,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image_file = $request->file('foto');
        $image_ekstensi = $image_file->extension();
        $image_nama = date('ymdhis') . '.' . $image_ekstensi;
        $image_file->move(public_path('photo'), $image_nama);

        Foto::create([
            'JudulFoto' => $request->JudulFoto,
            'DeskripsiFoto' => $request->DeskripsiFoto,
            'TanggalUnggah' => $request->TanggalUnggah,
            'LokasiFoto' => $request->LokasiFoto,
            'AlbumID' => $request->AlbumID,
            'UserID' => Auth::id(),
            'Foto' => $image_nama,
        ]);

        return redirect()->route('foto.index')->with('success', 'Foto berhasil ditambahkan');
    }

    public function edit($id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            return redirect()->route('foto.index')->with('error', 'Foto tidak ditemukan.');
        }

        if ($foto->UserID !== Auth::id()) {
            return redirect()->route('foto.index')->with('error', 'Anda tidak memiliki akses untuk mengedit foto ini.');
        }

        $albums = Album::all();
        return view('foto.edit', compact('foto', 'albums'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'JudulFoto' => 'required|string|max:255',
        'DeskripsiFoto' => 'required|string',
        'TanggalUnggah' => 'required|date',
        'LokasiFoto' => 'required|string',
        'AlbumID' => 'required|exists:albums,id',
    ]);

    $foto = Foto::find($id);

    if (!$foto) {
        return redirect()->route('foto.index')->with('error', 'Foto tidak ditemukan.');
    }

    if ($foto->UserID !== Auth::id()) {
        return redirect()->route('foto.index')->with('error', 'Anda tidak memiliki akses untuk mengedit foto ini.');
    }

    $data = [
        'JudulFoto' => $request->input('JudulFoto'),
        'DeskripsiFoto' => $request->input('DeskripsiFoto'),
        'TanggalUnggah' => $request->input('TanggalUnggah'),
        'LokasiFoto' => $request->input('LokasiFoto'),
        'AlbumID' => $request->input('AlbumID'),
    ];

    if ($request->hasFile('foto')) {
        $request->validate([
            'foto' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image_file = $request->file('foto');
        $image_ekstensi = $image_file->extension();
        $image_nama = date('ymdhis') . '.' . $image_ekstensi;
        $image_file->move(public_path('photo'), $image_nama);

        if ($foto->Foto && File::exists(public_path('photo/' . $foto->Foto))) {
            File::delete(public_path('photo/' . $foto->Foto));
        }

        $data['Foto'] = $image_nama;
    }

    $foto->update($data);

    return redirect()->route('foto.index')->with('success', 'Foto berhasil diperbarui.');
}

public function destroy($id)
{
    $foto = Foto::find($id);

    if (!$foto) {
        return redirect()->route('foto.index')->with('error', 'Foto tidak ditemukan.');
    }

    if ($foto->UserID !== Auth::id()) {
        return redirect()->route('foto.index')->with('error', 'Anda tidak memiliki akses untuk menghapus foto ini.');
    }

    if ($foto->Foto && File::exists(public_path('photo/' . $foto->Foto))) {
        File::delete(public_path('photo/' . $foto->Foto));
    }

    $foto->delete();

    return redirect()->route('foto.index')->with('success', 'Foto berhasil dihapus.');
}

    public function show($id)
    {
        $foto = Foto::with(['komentarFotos' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($id);

        if (!$foto) {
            return redirect()->route('foto.index')->with('error', 'Foto tidak ditemukan.');
        }

        return view('foto.show', compact('foto'));
    }

    public function download($id)
    {
        $foto = Foto::findOrFail($id);
        $filePath = public_path('photo/' . $foto->foto);
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, $foto->JudulFoto . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }
}
