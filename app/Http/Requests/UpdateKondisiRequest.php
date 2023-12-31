<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKondisiRequest extends FormRequest
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
    public function rules(): array
    {

        $kondisiId = $this->route('kondisi')->id;

        return [
            'kode' => 'required|string|max:10|unique:kondisis,kode,' . $kondisiId,
            'nama' => [
                'required',
                'string',
                'max:20',
                Rule::unique('kondisis', 'nama')->ignore($kondisiId)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'kode.required' => 'Kolom kode wajib diisi.',
            'kode.string' => 'Kolom kode harus berupa teks.',
            'kode.max' => 'Kolom kode tidak boleh lebih dari :max karakter.',
            'kode.unique' => 'Kode sudah terdaftar.',
            'nama.required' => 'Kolom nama wajib diisi.',
            'nama.string' => 'Kolom nama harus berupa teks.',
            'nama.max' => 'Kolom nama tidak boleh lebih dari :max karakter.',
            'nama.unique' => 'Kondisi sudah terdaftar.',
        ];
    }
}
