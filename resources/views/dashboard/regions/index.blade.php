@extends('dashboard.main')

@section('content')
<div class="container-xl mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list d-flex">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalAddRegion">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5v14m-7-7h14" />
                                </svg>
                                Tambah Region
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Provinsi</th>
                                <th>Kota</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($provinces as $province)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $province->name }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($province->cities as $city)
                                                <li>{{ $city->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.regions.edit', $province->id) }}" class="btn btn-warning">Edit</a>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteProvince{{ $province->id }}">Hapus</button>
                                    </td>
                                </tr>

                                <!-- Modal Delete Province -->
                                <div class="modal fade" id="modalDeleteProvince{{ $province->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center py-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 9v2m0 4v.01" />
                                                    <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                                                </svg>
                                                <h3>Apakah anda yakin?</h3>
                                                <div class="text-muted">Data yang dihapus tidak dapat dikembalikan.</div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="w-100">
                                                    <div class="row">
                                                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                                                Batal
                                                            </a></div>
                                                        <div class="col">
                                                            <form action="{{ route('dashboard.regions.destroy', $province->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger w-100">
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Region -->
<div class="modal fade" id="modalAddRegion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Region</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.regions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Provinsi</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="cities" class="form-label">Kota</label>
                        <ul id="cities">
                            <li>
                                <input type="text" class="form-control mb-2" name="cities[]" required>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-secondary add-city">Tambah Kota</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.add-city').addEventListener('click', function() {
            var ul = document.getElementById('cities');
            var li = document.createElement('li');
            li.innerHTML = '<input type="text" class="form-control mb-2" name="cities[]" required>';
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