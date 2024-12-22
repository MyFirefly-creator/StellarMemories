@extends('component.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Foto</h1>

    <form action="{{ route('foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="JudulFoto" class="form-label">Judul Foto</label>
            <input type="text" class="form-control @error('JudulFoto') is-invalid @enderror" id="JudulFoto" name="JudulFoto" value="{{ old('JudulFoto', $foto->JudulFoto) }}">
            @error('JudulFoto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="DeskripsiFoto" class="form-label">Deskripsi Foto</label>
            <textarea class="form-control @error('DeskripsiFoto') is-invalid @enderror" id="DeskripsiFoto" name="DeskripsiFoto">{{ old('DeskripsiFoto', $foto->DeskripsiFoto) }}</textarea>
            @error('DeskripsiFoto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="TanggalUnggah" class="form-label">Tanggal Unggah</label>
            <input type="date" class="form-control @error('TanggalUnggah') is-invalid @enderror" id="TanggalUnggah" name="TanggalUnggah" value="{{ old('TanggalUnggah', $foto->TanggalUnggah) }}">
            @error('TanggalUnggah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="LokasiFoto" class="form-label">Lokasi Foto</label>
            <input type="text" class="form-control @error('LokasiFoto') is-invalid @enderror" id="LokasiFoto" name="LokasiFoto" value="{{ old('LokasiFoto', $foto->LokasiFoto) }}">
            @error('LokasiFoto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="AlbumID" class="form-label">Pilih Album</label>
            <select class="form-control @error('AlbumID') is-invalid @enderror" id="AlbumID" name="AlbumID">
                <option value="">-- Pilih Album --</option>
                @foreach($albums as $album)
                    <option value="{{ $album->id }}" {{ old('AlbumID', $foto->AlbumID) == $album->id ? 'selected' : '' }}>{{ $album->NamaAlbum }}</option>
                @endforeach
            </select>
            @error('AlbumID')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Ganti Foto</label>
            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
