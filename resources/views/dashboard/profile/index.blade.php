@extends('dashboard.main')

@section('custom-css')
    <style>
        .btn-edit-avatar {
            position: absolute;
            bottom: -15px;
            left: -15px;
            background-color: #868686;
            box-shadow: 0 0 0 3px #ffffff;
        }

        .avatar-custom-size {
            width: 12rem;
            height: 12rem;
        }

        .btn-delete:hover {
            background-color: #e74c3c;
            color: #ffffff;
            transition: 0.3s;
        }
    </style>
@endsection

@section('content')
    {{-- Page Header --}}
    <div class="page-header d-print-none mt-3">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h3 class="page-title">
                                Profil Saya
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center mt-3 ">
                                    <div class="col-12 text-center">
                                        @error('photo')
                                            <div class="text-danger fs-5 mb-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <span id="photoPreview" class="avatar avatar-custom-size rounded position-relative mb-5" style="background-image: url({{ auth()->user()->avatar_url ?? asset('img/default.jpg') }})">
                                            <label>
                                                <button class="btn btn-icon btn-muted rounded-circle btn-edit-avatar" type="button" onclick="document.getElementById('photoInput').click()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                                        <path d="M7 9l5 -5l5 5"></path>
                                                        <path d="M12 4l0 12"></path>
                                                    </svg>
                                                </button>
                                            </label>
                                            <input type="file" class="form-control" name="photo" id="photoInput" hidden accept=".jpg,.jpeg,.png">
                                        </span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="datagrid">
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Nama <span class="text-danger">*</span></div>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap" name="name" value="{{ old('name') ?? auth()->user()->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="datagrid">
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Email <span class="text-danger">*</span></div>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') ?? auth()->user()->email }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex">
                                    <a href="{{ getPreviousUrl(route('dashboard.home.index')) }}" type="button" class="btn me-auto">Kembali</a>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('library-js')
@endsection

@section('custom-js')
    <script>
        $('#photoInput').change(function() {
            if (this.files && this.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#photoPreview').css('background-image', 'url(' + e.target.result + ')');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endsection
