<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        return view('sesi.index');
    }

    public function showRegisterForm()
    {
        return view('sesi.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'Username' => 'required|string|max:255|unique:users,Username',
            'NamaLengkap' => 'required|string|max:255',
            'Alamat' => 'required|string|max:255',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $image_file = $request->file('image');
        $image_nama = date('ymdhis') . "." . $image_file->extension();

        if (!File::exists(public_path('profil'))) {
            File::makeDirectory(public_path('profil'), 0755, true);
        }

        $image_file->move(public_path('profil'), $image_nama);

        User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'Username' => $validated['Username'],
            'NamaLengkap' => $validated['NamaLengkap'],
            'Alamat' => $validated['Alamat'],
            'image' => $image_nama,
            'role' => 'user',
            'google_id' => null,
            'google_token' => null,
        ]);

        return redirect()->route('sesi.index')->with('success', 'Berhasil Registrasi.');
    }

    public function showLoginForm()
    {
        return view('sesi.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return redirect()->route('index')->with('success', 'Selamat datang!');
        }

        return redirect()->route('sesi.login')->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('sesi.login')->with('success', 'Anda telah logout.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('sesi.profil.index')->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('sesi.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('sesi.profil.index')->with('error', 'Pengguna tidak ditemukan.');
        }

        $validated = $request->validate([
            'email' => 'required|string|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'Username' => 'required|string|max:255|unique:users,Username,' . $id,
            'NamaLengkap' => 'required|string|max:255',
            'Alamat' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg',
        ]);

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $image_nama = date('ymdhis') . "." . $image_file->extension();

            if (!File::exists(public_path('profil'))) {
                File::makeDirectory(public_path('profil'), 0755, true);
            }

            $image_file->move(public_path('profil'), $image_nama);

            if ($user->image && file_exists(public_path('profil/' . $user->image))) {
                @unlink(public_path('profil/' . $user->image));
            }

            $user->image = $image_nama;
        }

        $user->email = $validated['email'];
        $user->Username = $validated['Username'];
        $user->NamaLengkap = $validated['NamaLengkap'];
        $user->Alamat = $validated['Alamat'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('sesi.profil.index')->with('success', 'Berhasil memperbarui data pengguna.');
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function profil()
    {
        $user = auth()->user();
        $albums = $user->albums ?? [];
        $photos = $user->photos ?? [];
        return view('profil.index', compact('user', 'albums', 'photos'));
    }
}
