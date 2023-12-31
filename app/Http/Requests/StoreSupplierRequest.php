<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'nama' => 'required|max:125',
            'pabrik' => 'required|unique:suppliers,pabrik|max:125',
            'alamat' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama supplier harus diisi.',
            'nama.max' => 'Nama supplier tidak boleh lebih dari 125 karakter.',
            'pabrik.required' => 'Nama pabrik harus diisi.',
            'pabrik.unique' => 'Pabrik sudah terdaftar.',
            'pabrik.max' => 'Nama pabrik tidak boleh lebih dari 125 karakter.',
            'alamat.required' => 'Alamat supplier harus diisi.',
            'alamat.max' => 'Alamat supplier tidak boleh lebih dari 255 karakter.',
        ];
    }
}
