@extends('component.app')

@section('content')
<div class="container">
    <h1>Edit Pengguna</h1>
    <form action="{{ route('sesi.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (kosongkan jika tidak diganti)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label for="Username" class="form-label">Username</label>
            <input type="text" name="Username" id="Username" value="{{ old('Username', $user->Username) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="NamaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" name="NamaLengkap" id="NamaLengkap" value="{{ old('NamaLengkap', $user->NamaLengkap) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Alamat" class="form-label">Alamat</label>
            <input type="text" name="Alamat" id="Alamat" value="{{ old('Alamat', $user->Alamat) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Foto Profil</label>
            <input type="file" name="image" id="image" class="form-control">
            <small>Foto sebelumnya: {{ $user->image }}</small>
        </div>

        @if(Auth::user() && Auth::user()->role === 'admin')
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" name="role" id="role" value="{{ old('role', $user->role) }}" class="form-control" required>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
