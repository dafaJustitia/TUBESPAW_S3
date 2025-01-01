<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login - Ruang Obat</title>
    <!-- CSS files -->
    <link href="{{ asset('plugins/tabler/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/tabler/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/tabler/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/tabler/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/tabler/dist/css/demo.min.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('plugins/toast/dist/simple-notify.min.css') }}" />
    <script src="{{ asset('plugins/toast/dist/simple-notify.min.js') }}"></script>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        @media (min-width: 1024px) {
            body {
                background-image: url("{{ asset('background.png') }}");
                background-position: right;
                background-repeat: no-repeat;
                /* Background size by height and width screen 1280x720 */
                background-size: 50% 100%;
            }
        }

        .form-control {
            border: 1px solid brown;
            /* Ubah warna border menjadi coklat */
        }

        .input-group-text {
            border: 1px solid brown;
            /* Ubah warna border menjadi coklat */
            background-color: white;
            /* Ubah warna latar belakang jika diperlukan */
        }

        .btn-primary {
            background-color: brown;
            /* Ubah warna latar belakang tombol menjadi coklat */
            border-color: brown;
            /* Ubah warna border tombol menjadi coklat */
        }

        .btn-primary:hover {
            background-color: darkbrown;
            border-color: darkbrown;
            /* Ubah warna border tombol saat hover menjadi coklat lebih gelap */
        }

        .card {
            border: 1px solid brown;
            /* Ubah warna border kartu menjadi coklat */
        }
    </style>
</head>

<body class="d-flex flex-column">
    <script src="{{ asset('plugins/tabler/dist/js/demo-theme.min.js?1669759017') }}"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-3 mt-4">
                <a class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('img/logo.png') }}" width="130" alt="">
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="text-center mb-4">Login</h2>
                    <form action="{{ route('auth.authenticate') }}" method="POST" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label required">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Masukkan email anda"
                                id="email" {{ session('error') ?: 'autofocus' }} value="{{ old('email') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label required">
                                Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukkan password anda" id="password" value="{{ old('password') }}">
                                <span class="input-group-text">
                                    <a class="link-secondary" data-bs-toggle="tooltip" id="btnShowPassword"
                                        title="Show password" onclick="event.preventDefault();">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <circle cx="12" cy="12" r="2" />
                                            <path
                                                d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" name="remember_me" value="1"
                                        {{ old('remember_me') ? 'checked' : '' }}>
                                    <span class="form-check-label">Ingat saya</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Masuk</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="hr-text">Or</div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <a href="{{ route('auth.redirectToGoogle') }}" class="btn w-100">
                <img class="google-icon me-2" src="{{ asset('img/sosmed/google.svg') }}" width="20">
                Masuk dengan Google
              </a>
            </div>
          </div>
        </div> --}}
            </div>
            <div class="text-center text-muted mt-5">
                © All rights reserved - Ruang Obat
            </div>
        </div>
    </div>
    <script src="{{ asset('plugins/tabler/dist/js/tabler.min.js?1669759017') }}" defer></script>
    <script src="{{ asset('plugins/tabler/dist/js/demo.min.js?1669759017') }}" defer></script>
    <script>
        @if ($errors->has('username') || $errors->has('password'))
            toastr('error', 'Gagal', 'Email dan password wajib diisi!')
        @endif

        @if (session('error'))
            toastr('error', 'Gagal', '{{ session('error') }}')
        @endif

        @if (session('success'))
            toastr('success', 'Berhasil', '{{ session('success') }}')
        @endif

        function toastr(status = 'success', title = 'Toast Title', text = 'Toast Text') {
            new Notify({
                status: status,
                title: title,
                text: text,
                effect: 'fade',
                speed: 300,
                showIcon: true,
                showCloseButton: true,
                autoclose: true,
                autotimeout: 3000,
                gap: 20,
                distance: 20,
                type: 3,
                position: 'right top',
            })
        }

        const btnShowPassword = document.querySelector('#btnShowPassword')
        const inputPassword = document.querySelector('#password')

        btnShowPassword.addEventListener('click', function() {
            if (inputPassword.type === 'password') {
                inputPassword.type = 'text'
                btnShowPassword.innerHTML =
                    `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 3l18 18"></path>
                        <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83"></path>
                        <path d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c4 0 7.333 2.333 10 7c-.778 1.361 -1.612 2.524 -2.503 3.488m-2.14 1.861c-1.631 1.1 -3.415 1.651 -5.357 1.651c-4 0 -7.333 -2.333 -10 -7c1.369 -2.395 2.913 -4.175 4.632 -5.341"></path>
                    </svg>`;
            } else {
                inputPassword.type = 'password'
                btnShowPassword.innerHTML =
                    `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                    </svg>`
            }
        })
    </script>
</body>

</html>
