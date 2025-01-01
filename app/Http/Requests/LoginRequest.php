<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
            'remember_me' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'remember_me.boolean' => 'Ingat saya harus berupa boolean',
        ];
    }
}
