@extends('component.app')

@section('content')
<div class="container my-5">
    <div class="row gx-5">

        <div class="col-md-6">
            <div class="card shadow-lg mb-4">
                <img src="{{ asset('photo/' . $foto->foto) }}"
                     class="img-fluid rounded"
                     style="max-height: 600px; object-fit: cover;"
                     alt="{{ $foto->JudulFoto }}">
            </div>
        </div>

        <div class="col-md-6">

            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <h2 class="fw-bold text-primary">{{ $foto->JudulFoto }}</h2>
                    <p class="text-muted">{{ $foto->DeskripsiFoto }}</p>
                    <p><strong>Oleh:</strong> {{ $foto->user->Username }}</p>
                    <p><strong>Diunggah pada:</strong> {{ $foto->TanggalUnggah }}</p>

                    <form action="{{ route('foto.like', $foto->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm {{ $foto->isLikedBy(Auth::id()) ? 'btn-danger' : 'btn-outline-primary' }}">
                            <span class="material-symbols-outlined">
                                {{ $foto->isLikedBy(Auth::id()) ? 'favorite' : 'favorite_border' }}
                            </span>
                            {{ $foto->likeFotos()->count() }} Like
                        </button>
                        <a href="{{ route('foto.download', $foto->id) }}" class="btn btn-primary">
                            <span class="material-symbols-outlined">download</span></span> Download Foto
                        </a>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-secondary">Tambah Komentar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('komentar.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="FotoID" value="{{ $foto->id }}">
                        <div class="mb-3">
                            <textarea name="IsiKomentar" class="form-control"
                                      rows="3" placeholder="Tulis komentar..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill">
                            Kirim Komentar
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-secondary">Komentar</h5>
                </div>
                <div class="card-body">
                    @forelse ($foto->komentarFotos as $komentar)
                        <div class="d-flex mb-4">
                            <div class="me-3">
                                <img src="{{ asset('profil/' . $komentar->user->image ?? 'default.png') }}"
                                     class="rounded-circle border" width="40" height="40"
                                     alt="{{ $komentar->user->Username }}">
                            </div>
                            <div>
                                <p class="mb-1">
                                    <strong class="text-primary">{{ $komentar->user->Username }}</strong>
                                    <small class="text-muted">{{ $komentar->TanggalKomentar }}</small>
                                </p>
                                <p class="text-secondary mb-0">{{ $komentar->IsiKomentar }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">Belum ada komentar. Jadilah yang pertama!</p>
                    @endforelse
                </div>
            </div>

            <!-- Tombol untuk memicu Modal Laporan dengan jarak tambahan -->
            <button type="button" class="btn btn-warning w-100 mt-3" data-bs-toggle="modal" data-bs-target="#warningModal">
                <span class="material-symbols-outlined">warning</span>
                Laporkan Foto
            </button>

            <!-- Modal Laporan -->
            <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="warningModalLabel">Pilih Jenis Pelanggaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('warning.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="FotoID" value="{{ $foto->id }}">
                                <div class="mb-3">
                                    <label for="jenis_pelanggaran" class="form-label">Jenis Pelanggaran</label>
                                    <select id="jenis_pelanggaran" name="jenis_pelanggaran" class="form-select" required>
                                        <option value="Pelanggaran hak cipta">Pelanggaran hak cipta</option>
                                        <option value="Konten dewasa atau eksplisit">Konten dewasa atau eksplisit</option>
                                        <option value="Konten kebencian atau diskriminatif">Konten kebencian atau diskriminatif</option>
                                        <option value="Informasi palsu atau menyesatkan">Informasi palsu atau menyesatkan</option>
                                        <option value="Spam atau aktivitas manipulatif">Spam atau aktivitas manipulatif</option>
                                        <option value="Pelanggaran privasi orang lain">Pelanggaran privasi orang lain</option>
                                        <option value="Kekerasan atau konten yang mengganggu">Kekerasan atau konten yang mengganggu</option>
                                        <option value="Produk atau layanan ilegal">Produk atau layanan ilegal</option>
                                        <option value="Pelanggaran merek dagang">Pelanggaran merek dagang</option>
                                        <option value="Penyebaran malware atau konten berbahaya">Penyebaran malware atau konten berbahaya</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">Laporkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>
    .gallery-item img {
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease-in-out;
    }

    .gallery-item img:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .card {
        border-radius: 10px;
    }

    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        vertical-align: middle;
    }

    .card-body button {
        transition: background-color 0.3s ease-in-out;
    }

    .card-body button:hover {
        background-color: #0056b3;
    }

    .text-muted {
        font-size: 14px;
    }

    .btn-warning {
        transition: background-color 0.3s ease;
    }

    .btn-warning:hover {
        background-color: #f0ad4e;
        color: white;
    }
</style>
@endpush
