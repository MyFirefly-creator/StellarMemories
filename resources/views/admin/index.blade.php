@extends('component.app')

@section('content')
<div class="container">
    <h1 class="page-title text-center">Admin Panel</h1>

    <div class="user-management mt-4">
        <h2 class="section-title">Kelola User</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Jumlah Pelanggaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->Username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->NamaLengkap }}</td>
                    <td>{{ $user->warnings_count }}</td>
                    <td>
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#banModal" data-userid="{{ $user->id }}">Ban</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>
            {{ $users->links('pagination::bootstrap-5') }}
        </p>
    </div>

    <div class="view-warnings mt-5">
        <h2 class="section-title">Postingan Warning</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>ID Foto</th>
                    <th>Jenis Pelanggaran</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($warnings as $warning)
                    <tr>
                        @php
                            $foto = $warning->foto;
                        @endphp
                        <td>
                            @if($foto && $foto->foto)
                                <img src="{{ asset('photo/' . $foto->foto) }}" alt="Foto ID {{ $warning->FotoID }}" width="100">
                            @else
                                <p>No Image</p>
                            @endif
                        </td>
                        <td>{{ $warning->FotoID }}</td>
                        <td>{{ $warning->jenis_pelanggaran }}</td>
                        <td>{{ $warning->keterangan }}</td>
                        <td>
                            <a href="{{ route('foto.show', $warning->FotoID) }}" class="btn btn-secondary btn-sm">View</a>
                            <form action="{{ route('admin.foto.destroy', $warning->FotoID) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus Konten</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>
            {{ $warnings->links('pagination::bootstrap-5') }}
        </p>
    </div>
</div>

<div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('banned.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="banModalLabel">Ban User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="UserID" id="banUserID">
                    <div class="mb-3">
                        <label for="Deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="Deskripsi" name="Deskripsi" required>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Durasi</label>
                        <input type="number" class="form-control" id="duration" name="duration" required>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Satuan Waktu</label>
                        <select class="form-control" id="unit" name="unit" required>
                            <option value="minutes">Menit</option>
                            <option value="hours">Jam</option>
                            <option value="days">Hari</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Ban User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const banModal = document.getElementById('banModal');
    banModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const userID = button.getAttribute('data-userid');
        const userIDInput = document.getElementById('banUserID');
        userIDInput.value = userID;
    });
</script>
@endsection
