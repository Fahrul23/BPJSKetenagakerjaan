<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BarangUpdateRequest extends FormRequest
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
            'id' => 'integer|nullable',
            'item' => 'string|nullable',
            'type' => [Rule::in(['ambil', 'pinjam'])],
            'stock' => 'integer|nullable|min:1',
            'category' => 'integer|nullable',
            'kondisi_barang' => 'required',
            'image' => 'image|max:5000'
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
            'item.string' => 'Nama Barang harus diisi dengan karakter alfabet',

            'type.in'  => 'Data Jenis barang harus ambil atau pinjam',

            'category.integer'  => 'Kategori harus diisi',
            'kondisi_barang.required' => 'Kondisi barang harus diisi',

            'image.image'  => 'File gambar harus jpeg, png, bmp, gif, svg, atau webp',
            'image.size'  => 'Ukuran file tidak boleh lebih dari 5mb',
        ];
    }
}
