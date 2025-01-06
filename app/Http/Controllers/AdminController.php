<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warning;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('index')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $users = User::all();
        $warnings = Warning::all();

        return view('admin.index', compact('users', 'warnings'));
    }

    public function editUser($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('index')->with('error', 'Anda tidak memiliki akses.');
        }

        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        return view('sesi.edit', compact('user'));
    }

    public function destroyUser($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('index')->with('error', 'Anda tidak memiliki akses.');
        }

        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User berhasil dihapus.');
    }

    public function destroyFoto($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('index')->with('error', 'Anda tidak memiliki akses.');
        }

        $foto = Foto::find($id);

        if (!$foto) {
            abort(404);
        }

        $foto->komentarFotos()->delete();
        $foto->likeFotos()->delete();
        $foto->delete();

        return redirect()->route('admin.index')->with('success', 'Konten foto beserta komentar dan like berhasil dihapus.');
    }
}
