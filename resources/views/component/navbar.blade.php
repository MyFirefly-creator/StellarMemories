<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Stellar Memories</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('album.index') }}">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('foto.index') }}">Foto</a>
                </li>
                @if(Auth::user() && Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('admin.index') }}">Admin</a>
                    </li>
                @endif
            </ul>

            <form action="{{ route('index') }}" method="GET" class="d-flex me-3" role="search">
                <input class="form-control me-2" type="text" name="query" placeholder="Cari Foto..." value="{{ request('query') }}">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            @if(Auth::check())
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('profil/' . Auth::user()->image) }}" alt="Profile" class="rounded-circle" width="30" height="30">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('sesi.profil.index') }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('sesi.logout') }}">Logout</a></li>
                    </ul>
                </div>
            @else
                <div>
                    <a href="{{ route('sesi.login') }}" class="btn btn-outline-primary me-2">Login</a>
                    <a href="{{ route('sesi.register') }}" class="btn btn-primary">Register</a>
                </div>
            @endif
        </div>
    </div>
</nav>

<style>
    .rounded-circle {
        object-fit: cover;
    }
    @media (max-width: 991px) {
        .navbar .form-control {
            width: 100%;
            margin-bottom: 10px;
        }
        .navbar .dropdown, .navbar div {
            margin-top: 10px;
        }
    }
</style>
