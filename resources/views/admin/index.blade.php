@extends('component.app')

@section('content')
<div class="container">
    <h1 class="page-title text-center">Admin Panel</h1>

    <!-- Kelola User Section -->
    <div class="user-management mt-4">
        <h2 class="section-title">Kelola User</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->Username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->NamaLengkap }}</td>
                    <td>
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
                            $foto = $warning->foto; // Ambil relasi Foto dari Warning
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
    </div>
</div>
@endsection
