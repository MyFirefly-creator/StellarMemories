<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stellar Memories</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .carousel-inner {
      height: 550px;
    }

    .carousel-item {
      height: 100%;
    }

    .carousel-item img {
      object-fit: cover;
      height: 100%;
      width: 100%;
    }

    .carousel-item .carousel-caption {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
      text-align: center;
    }

    .navbar-brand img {
      width: 40px;
      height: auto;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ url('img/Logo.jpg') }}" alt="Logo" class="me-2">
        Stellar Memories
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="btn btn-danger me-2" href="{{ route('sesi.login') }}">Masuk</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-light" href="{{ route('sesi.register') }}">Daftar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ url('img/FF.jpeg') }}" class="d-block w-100" alt="Slide 1">
          <div class="carousel-caption">
            <h3>Dapatkan Ide</h3>
            <p>Temukan inspirasi terbaik untuk proyek Anda</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ url('img/BA.png') }}" class="d-block w-100" alt="Slide 2">
          <div class="carousel-caption">
            <h3>Jelajahi Inspirasi</h3>
            <p>Jelajahi berbagai ide kreatif dari seluruh dunia</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ url('img/Tohka.jpg') }}" class="d-block w-100" alt="Slide 3">
          <div class="carousel-caption">
            <h3>Bagikan Ide Anda</h3>
            <p>Berbagi ide kreatif dan inspirasi dengan komunitas</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </button>
    </div>
  </main>

  <footer class="bg-light text-center py-3">
    <p class="mb-0">Copyright &copy; 2024 Stellar Memories. All Rights Reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
