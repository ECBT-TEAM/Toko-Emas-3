<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKategoriRequest extends FormRequest
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
        $userId = $this->route('kategori');

        return [
            'kode' => [
                'required',
                'max:5',
                Rule::unique('kategoris', 'kode')->ignore($userId->id),
            ],
            'nama' => 'required|max:125'
        ];
    }

    public function messages(): array
    {
        return [
            'kode.required' => 'Kode harus diisi',
            'kode.max' => 'Kode tidak boleh lebih dari 5 karakter',
            'kode.unique' => 'Kode sudah digunakan sebelumnya',
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama tidak boleh lebih dari 125 karakter',
        ];
    }
}
