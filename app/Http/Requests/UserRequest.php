<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required|string',
            'role' => ['required', Rule::in(['admin', 'user'])],
            'email' => 'required|unique:users'
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
            'name.required' => 'Nama user harus diisi',

            'role.required'  => 'Role user harus diisi',
            'role.in'  => 'Data role user harus admin atau user',

            'email.required'  => 'Email harus diisi',
            'email.unique'  => 'Email ini sudah terdaftar',
        ];
    }
}
