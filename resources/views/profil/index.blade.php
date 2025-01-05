@extends('component.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <div class="profile-img">
                <img src="{{ asset('profil/' . (Auth::user()->image ?? 'default.png')) }}" alt="Profile Image" class="rounded-circle" width="150" height="150">
            </div>
            <h2 class="mt-3">{{ $user->NamaLengkap }}</h2>
            <p class="text-muted">{{ $user->Username }}</p>
            <a href="{{ route('sesi.user.edit', $user->id) }}" class="btn btn-primary mt-3">Edit Profil</a>  <!-- Tombol edit profil -->
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <h4>Informasi Akun</h4>
            <ul class="list-group">
                <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>Alamat:</strong> {{ $user->Alamat }}</li>
            </ul>
        </div>
    </div>

    <div class="row mb-5">
        <h4>Galeri yang Dibuat</h4>
        @forelse($user->albums as $dataGaleri)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $dataGaleri->NamaAlbum }}</h5>
                    <p class="card-text">{{ Str::limit($dataGaleri->Deskripsi, 100) }}</p>
                    <p><small>Di buat pada: {{ $dataGaleri->TanggalDibuat }}</small></p>
                </div>
            </div>
        </div>
        @empty
        <p>Belum ada album yang dibuat.</p>
        @endforelse
    </div>

    <div class="row">
        <h4>Foto yang Dibuat</h4>
        @forelse($user->fotos as $dataFoto)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('photo/' . $dataFoto->foto) }}" class="card-img-top" alt="Foto Thumbnail">
                <div class="card-body">
                    <h5 class="card-title">{{ $dataFoto->JudulFoto }}</h5>
                    <p class="card-text">{{ Str::limit($dataFoto->DeskripsiFoto, 100) }}</p>
                    <p><small>Di unggah pada: {{$dataFoto->TanggalUnggah }}</small></p>
                </div>
            </div>
        </div>
        @empty
        <p>Belum ada foto yang diunggah.</p>
        @endforelse
    </div>
</div>

<style>
    .profile-img img {
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 10px;
    }

    .card-img-top {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        object-fit: cover;
        height: 200px;
    }

    .card-body {
        padding: 15px;
    }

    .card-body h5 {
        font-size: 1.2em;
        font-weight: bold;
    }

    .card-body p {
        color: #555;
    }

    .container {
        background-color: #f8f9fa;
    }

    @media (max-width: 768px) {
        .col-md-4 {
            width: 100%;
        }
    }
</style>

@endsection
