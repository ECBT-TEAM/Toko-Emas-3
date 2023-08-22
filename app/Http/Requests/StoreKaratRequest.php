<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreKaratRequest extends FormRequest
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
            'kode' => 'required|string|max:5',
            'nama' => 'required|integer|unique:karats,nama',
        ];
    }

    public function messages(): array
    {
        return [
            'kode.required' => 'Kolom kode wajib diisi.',
            'kode.string' => 'Kolom kode harus berupa teks.',
            'kode.max' => 'Kolom kode tidak boleh lebih dari :max karakter.',
            'nama.required' => 'Kolom jenis wajib diisi.',
            'nama.integer' => 'Kolom jenis harus berupa angkat.',
            'nama.unique' => 'Jenis karat sudah terdaftar.',
        ];
    }
}
