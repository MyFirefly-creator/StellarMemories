<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .btn-google {
            background-color: #db4437;
            color: white;
            border: none;
            padding: 10px;
            text-align: center;
            width: 100%;
            font-weight: 600;
            border-radius: 5px;
        }
        .btn-google:hover {
            background-color: #c1351d;
            text-decoration: none;
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
                    <h4 class="text-center mb-4">Login</h4>
                    <!-- Menampilkan error login jika ada -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('sesi.login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <p class="mt-3 text-center">Belum punya akun? <a href="{{ route('sesi.register') }}">Daftar di sini</a></p>

                    <!-- Google Login Button -->
                    <div class="mt-3 text-center">
                        <a href="auth/redirect" class="btn-google">Login dengan Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
