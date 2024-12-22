@extends('component.app')

@section('content')
<div class="main-content">
    <div class="container mt-4">
        <h1 class="mb-4">Daftar Foto</h1>

        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul Foto</th>
                    <th>Deskripsi Foto</th>
                    <th>Tanggal Unggah</th>
                    <th>Lokasi Foto</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataFoto as $foto)
                <tr>
                    <td>{{ $foto->JudulFoto }}</td>
                    <td>{{ $foto->DeskripsiFoto }}</td>
                    <td>{{ $foto->TanggalUnggah }}</td>
                    <td>{{ $foto->LokasiFoto }}</td>
                    <td>
                        <img src="{{ asset('photo/' . $foto->foto) }}" alt="{{ $foto->JudulFoto }}" style="width: 100px; height: auto;">
                    </td>
                    <td>
                        <a href="{{ route('foto.edit', $foto->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('foto.show', $foto->id) }}" class="btn btn-secondary btn-sm">View</a>
                        <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-button">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada foto</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('foto.create') }}" class="btn btn-success">Tambah Foto</a>

        <div class="mt-3">
            {{ $dataFoto->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Yakin ingin menghapus foto ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
