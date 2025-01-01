<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Produk di Kota Anda</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('landing/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
        rel="stylesheet">

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



        .btn-secondary {
            background-color: transparent;
            color: brown;
            border: 1px solid brown;
            margin-top: 10px;
            /* Tambahkan margin atas untuk memberikan jarak */
        }

        .btn-secondary:hover {
            background-color: brown;
            color: white;
            transition: 0.3s;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 15px;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .sidebar {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            height: 100%;
            background-color: white;
            transition: left 0.3s ease;
            z-index: 1000;
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            cursor: pointer;
        }

        .section-title {
            margin-bottom: 20px;
            text-align: center;
            /* This centers the title */
        }

        .container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            /* Centers the content */
            align-items: center;
            flex-direction: column;
        }

        .card {
            margin-bottom: 20px;
        }

        @media screen and (min-width: 768px) {
            .hero-text {
                /* Your styles here */
            }
        }
    </style>
</head>

<body>
    <header>
        <!-- Header content -->
    </header>

    <main>
        <div class="container">
            <h2 class="h2 section-title">Cari Produk di Domisili Anda</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="sidebar-toggle" onclick="toggleSidebar()">☰</div>
                    <div class="sidebar" id="sidebar">
                        <form method="GET" action="{{ route('products.search') }}">
                            <div class="mb-3">
                                <label for="province_id" class="form-label"><br><br>Provinsi</label>
                                <select name="province_id" id="province_id" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="city_id" class="form-label">Kota</label>
                                <select name="city_id" id="city_id" class="form-control">
                                    <option value="">Pilih Kota</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-login w-100">Cari</button>
                            <a href="{{ route('landing.home.index') }}" class="btn btn-secondary w-100 mt-3">Kembali</a>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <section class="section featured-car" id="featured-product">
                        <div class="container">
                            <ul class="featured-car-list">
                                @foreach ($products as $product)
                                    <li>
                                        <div class="featured-car-card">
                                            <figure class="card-banner">
                                                <img src="{{ $product->image ?? asset('img/placeholder.jpeg') }}"
                                                    alt="produk" loading="lazy" width="440" height="300"
                                                    class="w-100">
                                            </figure>
                                            <div class="card-content">
                                                <div class="card-title-wrapper">
                                                    <h3 class="h3 card-title">{{ $product->name }}</h3>
                                                </div>
                                                <div class="card-text">
                                                    <p>{{ $product->description }}</p>
                                                </div>
                                                <div class="card-price-wrapper">
                                                    <p class="card-price">
                                                        <strong>{{ formatRupiah($product->price) }}</strong>
                                                    </p>
                                                    <a href="{{ route('products.handleClick', $product) }}"
                                                        class="btn btn-login" target="_blank">Beli</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            @if (request()->has('province_id') && request()->has('city_id') && $products->isEmpty())
                                <div style="margin-top: 50px; margin-bottom: 50px;">
                                    <p style="text-align: center; font-size: 20px; color: #6c757d;">Obat Tidak Ditemukan
                                    </p>
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }

        document.getElementById('province_id').addEventListener('change', function() {
            var provinceId = this.value;
            var citySelect = document.getElementById('city_id');
            citySelect.innerHTML = '<option value="">Pilih Kota</option>';

            if (provinceId) {
                fetch('/cities/' + provinceId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(city => {
                            var option = document.createElement('option');
                            option.value = city.id;
                            option.text = city.name;
                            citySelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
</body>

</html>
