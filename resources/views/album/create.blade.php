@extends('component.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Album Baru</h1>

    <form action="{{ route('album.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="NamaAlbum" class="form-label">Nama Album</label>
            <input type="text" class="form-control @error('NamaAlbum') is-invalid @enderror" id="NamaAlbum" name="NamaAlbum" value="{{ old('NamaAlbum') }}">
            @error('NamaAlbum')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('Deskripsi') is-invalid @enderror" id="Deskripsi" name="Deskripsi">{{ old('Deskripsi') }}</textarea>
            @error('Deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="TanggalDibuat" class="form-label">Tanggal Dibuat</label>
            <input type="date" class="form-control @error('TanggalDibuat') is-invalid @enderror" id="TanggalDibuat" name="TanggalDibuat" value="{{ old('TanggalDibuat') }}">
            @error('TanggalDibuat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
