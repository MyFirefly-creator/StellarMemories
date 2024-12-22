<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warning;
use App\Models\Foto;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();

        $warnings = Warning::all();

        return view('admin.index', compact('users', 'warnings'));
    }

    public function editUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
        return view('sesi.edit', compact('user'));
    }

    public function destroyUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User berhasil dihapus.');
    }

    public function destroyFoto($id)
{
    $foto = Foto::find($id);

    if (!$foto) {
        return redirect()->back()->with('error', 'Foto tidak ditemukan.');
    }

    $foto->komentarFotos()->delete();

    $foto->likeFotos()->delete();

    $foto->delete();

    return redirect()->route('admin.index')->with('success', 'Konten foto beserta komentar dan like berhasil dihapus.');
}

}
