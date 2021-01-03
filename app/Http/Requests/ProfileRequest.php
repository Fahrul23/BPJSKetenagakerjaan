<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'string|nullable',
            'email' => 'email|nullable|unique:users,email'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.string' => 'Data harus berbentuk karakter alphabet, simbol, atau angka',

            'email.email' => 'Data harus berbentuk alamat email',
            'email.unique' => 'Email yang dimasukan sudah terdaftar'
        ];
    }
}
