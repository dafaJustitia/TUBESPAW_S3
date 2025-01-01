<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'telp' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg|max:10000',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama harus kurang dari 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus berupa email yang valid',
            'email.unique' => 'Email sudah digunakan',
            'telp.string' => 'Telepon harus berupa string',
            'telp.max' => 'Telepon harus kurang dari 255 karakter',
            'address.string' => 'Alamat harus berupa string',
            'address.max' => 'Alamat harus kurang dari 255 karakter',
            'photo.image' => 'Foto harus berupa gambar',
            'photo.mimes' => 'Foto harus berupa file bertipe: jpeg, png, jpg',
            'photo.max' => 'Foto harus kurang dari 10MB',
            'linkedin_url.url' => 'URL LinkedIn harus berupa URL yang valid',
            'instagram_url.url' => 'URL Instagram harus berupa URL yang valid',
            'facebook_url.url' => 'URL Facebook harus berupa URL yang valid',
            'twitter_url.url' => 'URL Twitter harus berupa URL yang valid',
        ];
    }
}
