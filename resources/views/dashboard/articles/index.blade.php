
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
            artikel
          </div>
        </div>
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list d-flex">
            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalAddArticle">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5v14m-7-7h14" />
              </svg>
              Tambah Artikel
            </a>
          </div>
        </div>
      </div>
      <div class="row g-2 align-items-center">
        <div class="col-12 col-sm-8 col-md-6 col-xl-4 mt-3 d-flex">
          <div class="input-group me-2">
            <input type="text" class="form-control" placeholder="Cari ..." id="inputSearch"
              value="{{ request()->q }}">
            <button class="btn btn-icon" type="button" id="btnSearch">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                <path d="M21 21l-6 -6"></path>
              </svg>
            </button>
          </div>
          <a href="#" class="btn btn-outline-primary btn-icon" data-bs-toggle="modal"
            data-bs-target="#modal-option">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter" width="24"
              height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
              stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M5.5 5h13a1 1 0 0 1 .5 1.5l-5 5.5l0 7l-4 -3l0 -4l-5 -5.5a1 1 0 0 1 .5 -1.5"></path>
            </svg>
          </a>
        </div>
        <div class="col-auto mt-3">
          @if (isParamsExist($allowedParams))
            <a href="{{ route('dashboard.articles.index') }}" class="btn btn-outline-danger btn-icon"
              data-bs-toggle="tooltip" data-bs-original-title="Bersihkan filter pencarian" data-bs-placement="bottom">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 7h16"></path>
                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                <path d="M10 12l4 4m0 -4l-4 4"></path>
              </svg>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  {{-- Articles Table --}}
<div class="container-xl mt-4">
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th>Link</th>
        <th>Status</th>
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
            <a href="{{ route('dashboard.articles.edit', $article) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('dashboard.articles.destroy', $article) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
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
          {{-- <div class="mb-3">
            <label for="image" class="form-label">Foto</label>
            <input type="file" class="form-control" id="image" name="image" required>
          </div> --}}
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
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
        <form action="{{ route('dashboard.articles.store') }}" method="POST">
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
            <label for="is_published" class="form-label">Status</label>
            <select class="form-control" id="is_published" name="is_published" required>
              <option value="1">Published</option>
              <option value="0">Unpublished</option>
            </select>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection