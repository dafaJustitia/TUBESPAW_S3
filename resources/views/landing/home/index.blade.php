<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Obat</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/favicon.png">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('landing/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
        rel="stylesheet">

    <!-- Inline CSS -->
    <style>
        .btn-login {
            background-color: transparent;
            color: brown;
            border: 1px solid brown;
        }

        .btn-login:hover {
            background-color: brown;
            color: white;
            transition: 0.3s;
        }

        @media screen and (min-width: 768px) {
            .hero-text {
                width: 40%;
                color: rgb(0, 0, 0);
            }
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: center;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="header" data-header>
        <div class="container">
            <div class="overlay" data-overlay></div>
            <a href="#" class="logo"
                style="text-decoration: none; color: brown; font-weight: bold; font-size: 20px;">
                Ruang Obat
            </a>

            <nav class="navbar" data-navbar>
                <ul class="navbar-list">
                    <li><a href="#home" class="navbar-link" data-nav-link>Beranda</a></li>
                    <li><a href="#featured-product" class="navbar-link" data-nav-link>Produk</a></li>
                    <li><a href="#latest-articles" class="navbar-link" data-nav-link>Artikel</a></li>
                </ul>
            </nav>

            <div class="header-actions">
                <a href="https://wa.me/6281331419120" class="btn btn-login" target="_blank"><span>Contact</span></a>
                <a href="{{ route('auth.index') }}" class="btn btn-login" target="_blank"><span>Login Admin</span></a>
            </div>
        </div>
    </header>

    <main>
        <article>

            <!-- Hero Section -->
            <section class="section hero" id="home">
                <div class="container">
                    <div class="grid">
                        <div class="hero-content ">

                            <h2 class="h1 hero-title" style="font-weight: 900;">Ruang Obat</h2>
                            <p class="hero-text">
                                Selamat datang di Ruang Obat, platform digital yang mempermudah Anda untuk mencari,
                                membeli,
                                dan mendapatkan informasi seputar obat dengan cepat dan praktis.
                            </p>
                            <a href="https://wa.me/6281331419120" class="btn btn-login" target="_blank"
                                style="width: 40%;">Contact Kami</a>
                        </div>

                        <a href="#" class="logo">
                            <img src="{{ asset('img/tampilanobat.png') }}" alt="logo" style="width: 100%;">
                        </a>
                    </div>
                </div>
            </section>

            <!-- Featured Products Section -->
            <section class="section featured-car" id="featured-product">
                <div class="container">
                    <div class="title-wrapper">
                        <h2 class="h2 section-title">Obat Terbaru</h2>
                    </div>
                    <ul class="featured-car-list">
                        @foreach ($products as $product)
                            <li>
                                <div class="featured-car-card">
                                    <figure class="card-banner">
                                        <img src="{{ $product->image ? $product->image : asset('img/placeholder.jpeg') }}"
                                            alt="{{ $product->name }}" loading="lazy" width="440" height="300"
                                            class="w-100">
                                    </figure>
                                    <div class="card-content">
                                        <h3 class="h3 card-title">{{ $product->name }}</h3>
                                        <p class="card-text" style="font-size: 14px; color: #6c757d;">
                                            {{ $product->description }}
                                        </p>
                                        <p class="card-price"><strong>{{ formatRupiah($product->price) }}</strong></p>
                                        <br>
                                        <a href="{{ route('products.handleClick', $product) }}" class="btn btn-login"
                                            target="_blank">Beli</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    @if ($products->isEmpty())
                        <div style="text-align: center; margin: 50px 0;">
                            <p style="font-size: 20px; color: #6c757d;">Tidak ada Obat</p>
                        </div>
                    @endif

                    <div class="text-center mt-4" style="margin-top: 50px;">
                        <a href="{{ route('products.search') }}" class="btn btn-login">Cari Produk di Kota Anda</a>
                    </div>
                </div>
            </section>

            <!-- Latest Articles Section -->
            <section class="section latest-articles" id="latest-articles">
                <div class="container">
                    <div class="title-wrapper">
                        <h2 class="h2 section-title">Artikel Terbaru</h2>
                    </div>
                    <ul class="featured-car-list">
                        @foreach ($articles as $article)
                            <li>
                                <div class="featured-car-card">
                                    <figure class="card-banner">
                                        <img src="{{ $article->image ? $article->image : asset('img/placeholder.jpeg') }}"
                                            alt="{{ $article->title }}" loading="lazy" width="440" height="300"
                                            class="w-100">
                                    </figure>
                                    <div class="card-content">
                                        <h3 class="h3 card-title">{{ $article->title }}</h3>
                                        <p class="card-text" style="font-size: 14px; color: #6c757d;">
                                            {{ $article->description }}
                                        </p>
                                        <br>
                                        <a href="{{ route('articles.handleClick', $article) }}" class="btn btn-login" target="_blank">Baca
                                            Selengkapnya</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    @if ($articles->isEmpty())
                        <div style="text-align: center; margin: 50px 0;">
                            <p style="font-size: 20px; color: #6c757d;">Tidak ada Artikel</p>
                        </div>
                    @endif
                </div>
            </section>
        </article>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <!-- Footer content -->
            </div>
            <div class="footer-bottom">
                <p class="copyright">
                    &copy; 2024 <a href="#">Ruang Obat</a>. All Rights Reserved
                </p>
            </div>
        </div>
    </footer>

    <!-- Custom JS -->
    <script src="{{ asset('landing/script.js') }}"></script>
</body>

</html>
