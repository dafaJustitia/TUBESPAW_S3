@extends('dashboard.main')

@section('custom-css')
@endsection

@section('content')
  <div class="container-xl mt-4">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Artikel</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('dashboard.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" required>{{ $article->description }}</textarea>
              </div>
              <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="url" class="form-control" id="link" name="link" value="{{ $article->link }}" required>
              </div>
              <div class="mb-3">
                <label for="is_published" class="form-label">Status</label>
                <select class="form-control" id="is_published" name="is_published" required>
                  <option value="1" {{ $article->is_published ? 'selected' : '' }}>Published</option>
                  <option value="0" {{ !$article->is_published ? 'selected' : '' }}>Unpublished</option>
                </select>
              </div>
              {{-- <div class="mb-3">
                <label for="image" class="form-label">Foto</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($article->image)
                  <img src="{{ asset('storage/' . $article->image) }}" alt="Current Image" width="100">
                @endif
              </div> --}}
              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('dashboard.articles.index') }}" class="btn btn-secondary">Batal</a>
              </div>
            </form>
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
  // Custom JS here
</script>
@endsection