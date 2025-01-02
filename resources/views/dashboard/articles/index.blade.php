@extends('dashboard.main')

@section('custom-css')
    <style>
        .badge-outline {
            border: 1px solid;
            padding: 0.25em 0.5em;
            border-radius: 0.25rem;
        }

        .text-green {
            color: #28a745;
            border-color: #28a745;
        }

        .text-pink {
            color: #dc3545;
            border-color: #dc3545;
        }
    </style>
@endsection

@section('content')
    @include('sweetalert::alert')

    {{-- Page Header --}}
    <div class="page-header d-print-none mt-2">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h3 class="page-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M13 5h8" />
                            <path d="M13 9h5" />
                            <path d="M13 15h8" />
                            <path d="M13 19h5" />
                            <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        </svg>
                        {{ $title }}
                    </h3>
                    <div class="text-muted mt-1">
                        {{ $articles->firstItem() ?? '0' }}-{{ $articles->lastItem() ?? '0' }} dari
                        {{ $articles->total() }}
                        Artikel
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list d-flex">
                        <a href="#" class="btn btn-danger d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modalAddArticle" id="btnAdd">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Tambah Artikel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Articles Table --}}
    <div class="container-xl mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table datatable">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->description }}</td>
                        <td><a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a></td>
                        <td>
                            @if ($article->is_published)
                                <span class="badge badge-outline text-green">Aktif</span>
                            @else
                                <span class="badge badge-outline text-pink">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            @if ($article->image)
                                <img src="{{ $article->image }}" alt="{{ $article->title }}"
                                    style="width: 100px; height: auto;">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dashboard.articles.edit', $article) }}" class="btn btn-warning">Edit</a>
                            <button type="button" class="btn btn-danger btn-delete"
                                    data-id="{{ $article->id }}"
                                    data-name="{{ $article->title }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $articles->links() }}
    </div>

    {{-- Modal Add Article --}}
    <div class="modal fade" id="modalAddArticle" tabindex="-1" aria-labelledby="modalAddArticleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddArticleLabel">Tambah Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.articles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" class="form-control" id="link" name="link" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="is_published" class="form-label">Status</label>
                            <select class="form-control" id="is_published" name="is_published" required>
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-danger">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Delete Confirmation --}}
    <div class="modal modal-blur fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Apakah anda yakin?</h3>
                    <div class="text-muted">Data yang dihapus tidak dapat dikembalikan.</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">Batal</a></div>
                            <div class="col">
                                <form method="post" id="formDelete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger w-100" id="btnDelete">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function () {
            $(".btn-delete").on("click", function () {
                const id = $(this).data("id");
                const name = $(this).data("name");
                $("#modalDelete").modal("show");
                const action = `/dashboard/articles/${id}`;
                $("#formDelete").attr("action", action);
            });
        });
    </script>
@endsection
