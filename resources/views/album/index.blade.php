@extends('component.app')

@section('content')
<div class="main-content">
    <div class="container mt-4">
        <h1 class="mb-4">Daftar Album</h1>

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
                    <th>Nama Album</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataGaleri as $album)
                <tr>
                    <td>{{ $album->NamaAlbum }}</td>
                    <td>{{ $album->Deskripsi }}</td>
                    <td>{{ $album->TanggalDibuat }}</td>
                    <td>
                        <a href="{{ route('album.edit', $album->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('album.destroy', $album->id) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-button">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada album</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('album.create') }}" class="btn btn-success">Tambah Album</a>

        <div class="mt-3">
            {{ $dataGaleri->links() }}
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
                    title: 'Yakin ingin menghapus album ini?',
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
