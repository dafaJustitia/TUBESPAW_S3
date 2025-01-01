<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Province;
use App\Models\City;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()

    {
        return view('dashboard.products.index', [
            'title' => 'Daftar Produk',
            'products' => Product::options(request(Product::$allowedParams))
                ->paginate($this->validateAndGetLimit(request('limit'), 10)),
            'sortables' => Product::$sortables,
            'allowedParams' => Product::$allowedParams,
            'provinces' => Province::all(),

        ]);
    }
     public function create()
    {
        $provinces = Province::all();
        return view('dashboard.products.create', [
            'title' => 'Tambah Produk',
            'provinces' => $provinces,
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'), 'products');
        }

        Product::create($data);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }

     public function edit(Product $product)
    {
        $provinces = Province::all();
        $cities = City::where('province_id', $product->city->province_id)->get();
        return view('dashboard.products.edit', [
            'title' => 'Ubah Produk',
            'product' => $product,
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->deleteFile($product->image);
            $data['image'] = $this->storeImage($request->file('image'), 'products', true);
        }

        $product->update($data);
        return redirect($request->previous_url ?? route('dashboard.products.index'))->with('success', 'Produk berhasil diubah');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            $this->deleteFile($product->image);
        }
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
    public function handleClick(Product $product)
    {
        $product->increment('clicks');
        return redirect($product->url);
    }
     public function search(Request $request)
    {
        $query = Product::query();

        if ($request->filled('province_id')) {
            $query->whereHas('city.province', function($q) use ($request) {
                $q->where('id', $request->province_id);
            });
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $products = $query->get();
        $provinces = Province::all();

        return view('landing.products.index', compact('products', 'provinces'));
    }
}
