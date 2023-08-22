<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKaratRequest extends FormRequest
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

        $karatId = $this->route('karat')->id;

        return [
            'kode' => 'required|string|max:5',
            'nama' => [
                'required',
                'integer',
                Rule::unique('karats', 'nama')->where(function ($query) use ($karatId) {
                    return $query->where('id', '<>', $karatId);
                }),
            ],
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
            'nama.unique' => 'Jenis sudah terdaftar.',
        ];
    }
}
