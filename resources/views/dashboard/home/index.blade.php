@extends('dashboard.main')

@section('custom-css')
@endsection

@section('content')
    {{-- Page Header --}}
    <div class="page-header d-print-none mt-2">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h3 class="page-title">
                        {{ $title }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-xl-6">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <h2>Artikel dengan Klik Terbanyak</h2>
                                    <canvas id="articlesChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-6">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <h2>Produk dengan Klik Terbanyak</h2>
                                    <canvas id="productsChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('library-js')
@endsection

@section('custom-js')
<script>
    // Data for articles chart
    var articlesLabels = @json($topArticles->pluck('title'));
    var articlesClicks = @json($topArticles->pluck('clicks'));

    // Data for products chart
    var productsLabels = @json($topProducts->pluck('name'));
    var productsClicks = @json($topProducts->pluck('clicks'));

    // Articles chart
    var ctxArticles = document.getElementById('articlesChart').getContext('2d');
    var articlesChart = new Chart(ctxArticles, {
        type: 'bar',
        data: {
            labels: articlesLabels,
            datasets: [{
                label: 'Jumlah Klik',
                data: articlesClicks,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Products chart
    var ctxProducts = document.getElementById('productsChart').getContext('2d');
    var productsChart = new Chart(ctxProducts, {
        type: 'bar',
        data: {
            labels: productsLabels,
            datasets: [{
                label: 'Jumlah Klik',
                data: productsClicks,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection