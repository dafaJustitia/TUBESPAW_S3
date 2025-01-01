<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Produk di Kota Anda</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
        rel="stylesheet">

</head>

<body>
    <header>
        <!-- Header content -->
    </header>

    <main>
        <div class="container mt-4">
            <h2 class="h2 mb-4">Cari Produk di Domisili Anda</h2>
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="sidebar-toggle" onclick="toggleSidebar()">☰</div>
                    <div class="sidebar" id="sidebar">
                        <form method="GET" action="{{ route('products.search') }}">
                            <div class="mb-3">
                                <label for="province_id" class="form-label">Provinsi</label>
                                <select name="province_id" id="province_id" class="form-select">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="city_id" class="form-label">Kota</label>
                                <select name="city_id" id="city_id" class="form-select">
                                    <option value="">Pilih Kota</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cari</button>
                            <a href="{{ route('landing.home.index') }}" class="btn btn-secondary w-100 mt-3">Kembali</a>
                        </form>
                    </div>
                </div>

                <!-- Featured Products -->
                <div class="col-md-8">
                    <section class="section featured-car" id="featured-product">
                        <div class="container">
                            <ul class="list-unstyled">
                                @foreach ($products as $product)
                                    <li class="mb-4">
                                        <div class="card">
                                            <img src="{{ $product->image ?? asset('img/placeholder.jpeg') }}"
                                                class="card-img-top" alt="produk" loading="lazy">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text"
                                                    style="font-size: 14px; color: #6c757d; margin-bottom: 10px;">
                                                    {{ $product->description }}
                                                </p>
                                                <p class="card-price">
                                                    <strong>{{ formatRupiah($product->price) }}</strong>
                                                </p>
                                                <a href="{{ route('products.handleClick', $product) }}"
                                                    class="btn btn-outline-primary" target="_blank">Beli</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            @if (request()->has('province_id') && request()->has('city_id') && $products->isEmpty())
                                <div class="text-center my-5">
                                    <p class="fs-4 text-muted">Produk Tidak Ditemukan</p>
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
