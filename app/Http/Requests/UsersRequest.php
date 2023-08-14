<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|email",
            "status" => "required",
            "access" => "required",
            "password" => "required|min:8",
        ];
    }

    public function messages(): array
    {
        return [
            'firstname.required' => 'Nama Depan harus di isi',
            'lastname.required' => 'Nama Belakang harus di isi',
            'email.required' => 'Email harus di isi',
            'email.email' => 'Email sudah digunakan',
            'status.required' => 'Status harus di isi',
            'access.required' => 'Access harus di isi',
            'password.required' => 'Password harus di isi',
            'password.min' => 'Password minimal :min karakter'
        ];
    }
}
