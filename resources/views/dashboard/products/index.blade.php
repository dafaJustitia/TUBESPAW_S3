@extends('dashboard.main')

@section('custom-css')
  <style>
    .btn-action-delete:hover {
      background-color: #f44336;
      color: white;
      transition: 0.3s;
    }

    .user-photo:hover {
      opacity: 0.8;
      transition: 0.3s;
      cursor: pointer;
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
            {{ $products->firstItem() ?? '0' }}-{{ $products->lastItem() ?? '0' }} dari
            {{ $products->total() }}
            produk
          </div>
        </div>
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list d-flex">
            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
              data-bs-target="#modalAdd" id="btnAdd">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
              </svg>
              Tambah Produk
            </a>
            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modalAdd"
              aria-label="Tambah Produk">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
              </svg>
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
            <a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-danger btn-icon"
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

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>URL</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Status</th>
                    <th class="text-center">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                    <tr>
                      <td class="text-muted">{{ $loop->iteration + $products->firstItem() - 1 }}</td>
                      <td class="text-muted">
                        <a class="avatar me-2 img-preview cursor-pointer" data-fslightbox="product-{{ $product->id }}"
                          href="{{ $product->image ?? asset('img/placeholder.jpeg') }}"
                          style="background-image: url({{ $product->image ?? asset('img/placeholder.jpeg') }})">
                        </a>
                      </td>
                      <td class="text-muted">
                        <span {{ add_title_tooltip($product->name ?? '-', 30) }}>
                          {{ mb_strimwidth($product->name ?? '-', 0, 30, '...') }}
                        </span>
                      </td>
                      <td class="text-muted">
                        <span {{ add_title_tooltip($product->description ?? '-', 50) }}>
                          {{ mb_strimwidth($product->description ?? '-', 0, 50, '...') }}
                        </span>
                      </td>
                      <td class="text-muted">
                        {{ formatRupiah($product->price ?? 0) }}
                      </td>
                      <td class="text-muted">
                        <a href="{{ $product->url ?? '#' }}" target="_blank" class="text-decoration-none">
                          <span {{ add_title_tooltip($product->url ?? '-', 30) }}>
                            {{ mb_strimwidth($product->url ?? '-', 0, 30, '...') }}
                        </a>
                      </td>
                      <td class="text-muted">
                        {{ $product->city->province->name ?? '-' }}
                      </td>
                      <td class="text-muted">
                        {{ $product->city->name ?? '-' }}
                      </td>
                      <td>
                        @if ($product->is_published == 1)
                          <span class="badge badge-outline text-green">
                            Aktif
                          </span>
                        @else
                          <span class="badge badge-outline text-pink">
                            Tidak Aktif
                          </span>
                        @endif
                      </td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <button class="btn btn-icon btn-pill bg-muted-lt ms-1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical"
                              width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <circle cx="12" cy="12" r="1">
                              </circle>
                              <circle cx="12" cy="19" r="1">
                              </circle>
                              <circle cx="12" cy="5" r="1">
                              </circle>
                            </svg>
                          </button>
                          <div class="text-muted dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('dashboard.products.edit', $product->id) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit me-2"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                </path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                </path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                </path>
                                <path d="M16 5l3 3"></path>
                              </svg>
                              Ubah
                            </a>
                            <button class="dropdown-item btn-action-delete"
                              data-action="{{ route('dashboard.products.destroy', $product->id) }}"
                              data-bs-toggle="modal" data-bs-target="#modalDelete">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler me-2" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="4" y1="7" x2="20" y2="7" />
                                <line x1="10" y1="11" x2="10" y2="17" />
                                <line x1="14" y1="11" x2="14" y2="17" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                              </svg>
                              Hapus
                            </button>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  @if ($products->count() == 0)
                    <tr class="text-center">
                      <td colspan="99">
                        <div class="empty bg-transparent" style="height: 500px;">
                          <div class="empty-img"><img src="{{ asset('img\error\undraw_quitting_time_dm8t.svg') }}"
                              height="128">
                          </div>
                          <p class="empty-title">Produk tidak ditemukan</p>
                          <p class="empty-subtitle text-muted">
                            Coba sesuaikan pencarian atau filter untuk menemukan apa yang anda
                            cari.
                          </p>
                          <div class="empty-action">
                            <a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-danger">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="1"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                </path>
                                <path
                                  d="M4 7l16 0m-10 4l0 6m4 -6l0 6m-9 -10l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12m-10 0v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                </path>
                              </svg>
                              Bersihkan filter pencarian
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
            @if ($products->perPage() < $products->total())
              <div class="mt-3 ms-3">
                {{ $products->withQueryString()->onEachSide(1)->links('pagination.custom') }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal option --}}
  <div class="modal modal-blur fade" id="modal-option" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter Pencarian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="GET" id="formOption">
          <input type="hidden" name="q" id="q">
          <div class="modal-body">
            <div class="row mb-3">
              <div class="col-12">
                <div class="form-label">Tampilkan</div>
                <div class="form-selectgroup">
                  <label class="form-selectgroup-item">
                    <input type="radio" name="limit" value="20" class="form-selectgroup-input"
                      {{ request()->limit == '20' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      20
                    </span>
                  </label>
                  <label class="form-selectgroup-item">
                    <input type="radio" name="limit" value="50" class="form-selectgroup-input"
                      {{ request()->limit == '50' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      50
                    </span>
                  </label>
                  <label class="form-selectgroup-item">
                    <input type="radio" name="limit" value="100" class="form-selectgroup-input"
                      {{ request()->limit == '100' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      100
                    </span>
                  </label>
                  <label class="form-selectgroup-item">
                    <input type="radio" name="limit" value="200" class="form-selectgroup-input"
                      {{ request()->limit == '200' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      200
                    </span>
                  </label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <div class="form-label">Urutkan Berdasarkan</div>
                <select class="form-select" name="sortby">
                  <option value="" disabled selected>Pilih</option>
                  @foreach ($sortables as $key => $value)
                    <option value="{{ $key }}" {{ request()->sortby == $key ? 'selected' : '' }}>
                      {{ $value }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <div class="form-label">Urutan</div>
                <div class="form-selectgroup">
                  <label class="form-selectgroup-item">
                    <input type="radio" name="order" value="asc" class="form-selectgroup-input"
                      {{ request()->order == 'asc' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-sort-ascending-letters me-1" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 10v-5c0 -1.38 .62 -2 2 -2s2 .62 2 2v5m0 -3h-4"></path>
                        <path d="M19 21h-4l4 -7h-4"></path>
                        <path d="M4 15l3 3l3 -3"></path>
                        <path d="M7 6v12"></path>
                      </svg>
                      Ascending
                    </span>
                  </label>
                  <label class="form-selectgroup-item">
                    <input type="radio" name="order" value="desc" class="form-selectgroup-input"
                      {{ request()->order == 'desc' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-sort-descending-letters me-1" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 21v-5c0 -1.38 .62 -2 2 -2s2 .62 2 2v5m0 -3h-4"></path>
                        <path d="M19 10h-4l4 -7h-4"></path>
                        <path d="M4 15l3 3l3 -3"></path>
                        <path d="M7 6v12"></path>
                      </svg>
                      Descending
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer pt-2" style="border-top: 1px solid #e9ecef;">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnFormOption">Cari</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Modal delete --}}
  <div class="modal modal-blur fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
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
                <form method="post" id="formDelete">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger w-100" id="btnDelete">
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

  {{-- Modal add --}}
 <div class="modal modal-blur fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row mb-3">
              <div class="col">
                <div class="form-label required">Nama</div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                  placeholder="Nama Produk" value="{{ old('name') }}">
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
                  placeholder="Deskripsi Produk" rows="3">{{ old('description') }}</textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <div class="form-label required">Harga</div>
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                  placeholder="Harga Produk" value="{{ old('price') }}">
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
                  placeholder="URL Produk" value="{{ old('url') }}">
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
                      <option value="{{ $province->id }}">{{ $province->name }}</option>
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
                  <option value="1" {{ old('is_published') == '1' ? 'selected' : '' }}>Aktif</option>
                  <option value="0" {{ old('is_published') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('is_published')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="modal-footer pt-2" style="border-top: 1px solid #e9ecef;">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
              </svg>
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('library-js')
  <script src="{{ asset('plugins/tabler/dist/libs/fslightbox/index.js') }}" defer></script>
@endsection

@section('custom-js')
  <script>
    const formOption = document.getElementById('formOption');
    const btnFormOption = document.getElementById('btnFormOption');

    const inputSearch = document.getElementById('inputSearch');
    const btnSearch = document.getElementById('btnSearch');
    const q = document.getElementById('q');

    btnFormOption.addEventListener('click', submitFormOption);
    btnSearch.addEventListener('click', submitFormOption);
    inputSearch.addEventListener('keyup', function(event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        btnSearch.click();
      }
    });

    function submitFormOption() {
      q.value = inputSearch.value;
      formOption.submit();
    }

    const modalDelete = document.getElementById('modalDelete');

    modalDelete.addEventListener('show.bs.modal', function(event) {
      formDelete.action = event.relatedTarget.dataset.action;
    });

    $(document).ready(function() {
      @if ($errors->any())
        $('#modalAdd').modal('show');
      @endif
    });

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