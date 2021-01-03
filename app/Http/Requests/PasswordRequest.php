<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'pass_new' => 'required|string|min:8',
            'pass' => 'required|string|min:8|same:pass_new'
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
            'pass_new.required' => 'Password baru harus diisi',
            'pass_new.string' => 'Data harus berbentuk karakter alphabet, simbol, atau angka',
            'pass_new.min' => 'Password harus diisi minimal 8 karakter',

            'pass.required' => 'Ketik ulang password harus diisi',
            'pass.string' => 'Data harus berbentuk karakter alphabet, simbol, atau angka',
            'pass.min' => 'Password harus diisi minimal 8 karakter',
            'pass.same' => 'Password yang diisi harus sama',
        ];
    }
}
