@extends('dashboard.main')

@section('custom-css')
@endsection

@section('content')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center justify-content-center">
        <div class="col-md-6">
          <h2 class="page-title">
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
          </h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards justify-content-center">
        <div class="col-md-6">
          <form action="{{ route('dashboard.products.update', $product->id) }}" class="card" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="previous_url" value="{{ getPreviousUrl(route('dashboard.products.index')) }}">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col">
                  <div class="form-label required">Nama</div>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="Nama Produk" value="{{ old('name') ?? $product->name }}">
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <div class="form-label">Deskripsi</div>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    placeholder="Deskripsi Produk" rows="3">{{ old('description') ?? $product->description }}</textarea>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <div class="form-label required">Harga</div>
                  <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                    placeholder="Harga Produk" value="{{ old('price') ?? $product->price }}">
                  @error('price')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <div class="form-label required">URL</div>
                  <input type="text" class="form-control @error('url') is-invalid @enderror" name="url"
                    placeholder="URL Produk" value="{{ old('url') ?? $product->url }}">
                  @error('url')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <div class="form-label">Gambar</div>
                  <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    accept="image/*">
                  @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
               <div class="row mb-3">
              <div class="col">
                <div class="form-label required">Provinsi</div>
                <select name="province_id" class="form-control @error('province_id') is-invalid @enderror" id="province_id" required>
                  <option value="">Pilih Provinsi</option>
                  @foreach($provinces as $province)
                      <option value="{{ $province->id }}" {{ old('province_id', $product->province_id) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                  @endforeach
                </select>
                @error('province_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <div class="form-label required">Kota</div>
                <select name="city_id" class="form-control @error('city_id') is-invalid @enderror" id="city_id" required>
                  <option value="">Pilih Kota</option>
                </select>
                @error('city_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
              
              <div class="row mb-3">
                <div class="col">
                  <div class="form-label required">Status</div>
                  <select class="form-select @error('is_published') is-invalid @enderror" name="is_published">
                    <option value="" disabled selected>Pilih</option>
                    <option value="1" {{ old('is_published', $product->is_published) == '1' ? 'selected' : '' }}>Published</option>
                    <option value="0" {{ old('is_published', $product->is_published) == '0' ? 'selected' : '' }}>Unpublished</option>
                  </select>
                  @error('is_published')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="card-footer d-flex">
                <a href="{{ route('dashboard.products.index') }}" class="btn me-auto">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
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
@endsection