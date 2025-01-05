<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="{{ url('img/Logo.jpg') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
        background-color: #1b1b32;
        color: #fff;
        height: 100vh;
        padding: 20px;
        }
        .form-container {
        background-color: #252546;
        border-radius: 12px;
        color: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
        margin: 20px;
        padding: 30px;
        }
        .carousel-item img {
        height: calc(100vh - 40px);
        object-fit: cover;
        border-radius: 10px;
        }
        .btn-primary {
            background-color: #6a5acd;
            border: none;
        }
        a {
            color: #6a5acd;
        }
        a:hover {
            text-decoration: underline;
        }
        .form-label {
            font-weight: 600;
        }


    </style>
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-6 d-none d-md-block p-0">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ url('img/FF.jpeg') }}" class="d-block w-100" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ url('img/BA.png') }}" class="d-block w-100" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ url('img/Tohka.jpg') }}" class="d-block w-100" alt="Third slide">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <div class="form-container w-100 p-5">
                    <h4 class="text-center mb-4">Register</h4>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('sesi.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="Username" class="form-label">Username:</label>
                            <input type="text" name="Username" id="Username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="NamaLengkap" class="form-label">Nama Lengkap:</label>
                            <input type="text" name="NamaLengkap" id="NamaLengkap" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password:</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="Alamat" class="form-label">Alamat:</label>
                            <input type="text" name="Alamat" id="Alamat" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Unggah Foto:</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    </form>

                    <p class="mt-3 text-center">Sudah punya akun? <a href="{{ route('sesi.login') }}">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
