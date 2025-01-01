@extends('dashboard.main')

@section('content')
<div class="container-xl mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.regions.update', $province->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Provinsi</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $province->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="cities" class="form-label">Kota</label>
                            <ul id="cities">
                                @foreach ($province->cities as $city)
                                    <li class="d-flex align-items-center mb-2">
                                        <input type="text" class="form-control me-2" name="cities[]" value="{{ $city->name }}" required>
                                        <button type="button" class="btn btn-danger remove-city">Hapus</button>
                                    </li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn btn-secondary add-city">Tambah Kota</button>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('dashboard.regions.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.add-city').addEventListener('click', function() {
            var ul = document.getElementById('cities');
            var li = document.createElement('li');
            li.classList.add('d-flex', 'align-items-center', 'mb-2');
            li.innerHTML = '<input type="text" class="form-control me-2" name="cities[]" required><button type="button" class="btn btn-danger remove-city">Hapus</button>';
            ul.appendChild(li);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-city')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endsection