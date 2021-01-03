<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangAmbilTambahRequest extends FormRequest
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
            'image' => 'image|max:6000',
            'name' => 'required|unique:item_pinjam,name|max:255',
            'stock' => 'required|min:1|integer',
            'unit' => 'required|string|max:255',
            'category' => 'required|exists:category,id',
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

            'image.image' => ':attribute dengan format gambar',
            'image.max' => ':attribute maksimal ukuran :max kb',
            'image.present' => ':attribute harus diisi',

            'name.required'  => ':attribute harus diisi',
            'name.unique'  => ':attribute sudah terdaftar',
            'name.max'  => 'Isi :attribute kurang dari :max karakter',

            'stock.required'  => ':attribute harus diisi',
            'stock.min'  => ':attribute minimal input :min',
            'stock.integer'  => ':attribute harus berupa angka',
            
            'unit.required'  => ':attribute harus diisi',
            'unit.string'  => ':attribute harus gabungan dari huruf, angka, dan simbol',
            'unit.max'  => ':attribute maksimal diisi dengan :max karakter',

            'category.required'  => ':attribute harus diisi',
            'category.exists'  => ':attribute tidak terdaftar',

        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'image' => 'upload file',
            'name' => 'nama barang',
            'stock' => 'stok',
            'unit' => 'unit',
            'category' => 'kategori',
        ];
    }
}
