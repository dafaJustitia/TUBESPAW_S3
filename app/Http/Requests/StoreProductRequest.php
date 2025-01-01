<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'is_published' => 'required|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi',
            'name.string' => 'Nama produk harus berupa teks',
            'name.max' => 'Nama produk maksimal 255 karakter',
            'description.string' => 'Deskripsi produk harus berupa teks',
            'price.required' => 'Harga produk wajib diisi',
            'price.integer' => 'Harga produk harus berupa angka',
            'image.image' => 'Gambar produk harus berupa gambar',
            'image.mimes' => 'Gambar produk harus berupa file dengan format: jpeg, png, jpg, gif, svg',
            'url.required' => 'URL produk wajib diisi',
            'url.string' => 'URL produk harus berupa teks',
            'is_published.required' => 'Status publikasi produk wajib diisi',
            'is_published.boolean' => 'Status publikasi produk harus berupa boolean',
            'province_id.required' => 'Provinsi wajib dipilih.',
            'province_id.exists' => 'Provinsi yang dipilih tidak valid.',
            'city_id.required' => 'Kota wajib dipilih.',
            'city_id.exists' => 'Kota yang dipilih tidak valid.',
        ];
    }
}
