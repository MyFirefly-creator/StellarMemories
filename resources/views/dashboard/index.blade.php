@extends('component.app')

@section('content')
<div class="main-content">
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Galeri Foto</h1>

        @if(isset($query) && $query != '')
            <h4 class="text-center mb-4">Hasil pencarian untuk: <strong>"{{ $query }}"</strong></h4>
        @endif

        <div id="gallery">
            @forelse($fotoss as $foto)
                <div class="gallery-item">
                    <a href="{{ route('foto.show', $foto->id) }}">
                        <img src="{{ asset('photo/' . $foto->foto) }}" alt="{{ $foto->JudulFoto }}">
                    </a>
                </div>
            @empty
                <p class="text-center">Belum ada foto yang cocok dengan pencarian Anda.</p>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const grid = document.querySelector('#gallery');
        new Masonry(grid, {
            itemSelector: '.gallery-item',
            columnWidth: '.gallery-item',
            percentPosition: true,
            gutter: 10
        });
    });
</script>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
    }

    #gallery {
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .gallery-item {
        width: calc(33.333% - 10px);
        margin-bottom: 10px;
    }

    .gallery-item img {
        width: 100%;
        display: block;
        border-radius: 8px;
        transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .gallery-item img:hover {
        box-shadow: 0 8px 15px rgb(0, 0, 0);
        transform: translateY(-5px);
    }

    @media (max-width: 768px) {
        .gallery-item {
            width: calc(50% - 10px);
        }
    }

    @media (max-width: 480px) {
        .gallery-item {
            width: 100%;
        }
    }
</style>
@endsection
