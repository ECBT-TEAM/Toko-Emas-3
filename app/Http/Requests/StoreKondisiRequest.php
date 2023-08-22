<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKondisiRequest extends FormRequest
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
            'kode' => 'required|string|max:10',
            'nama' => 'required|string|max:20|unique:kondisis,nama',
        ];
    }

    public function messages(): array
    {
        return [
            'kode.required' => 'Kolom kode wajib diisi.',
            'kode.string' => 'Kolom kode harus berupa teks.',
            'kode.max' => 'Kolom kode tidak boleh lebih dari :max karakter.',
            'nama.required' => 'Kolom nama wajib diisi.',
            'nama.string' => 'Kolom nama harus berupa teks.',
            'nama.max' => 'Kolom nama tidak boleh lebih dari :max karakter.',
            'nama.unique' => 'Kondisi sudah terdaftar.',
        ];
    }
}
