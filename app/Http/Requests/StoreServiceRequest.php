<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'kondisi' => 'required|array|min:1',
            'kondisi.*' => 'exists:kondisis,id|required',
            'harga' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'kondisi.required' => 'Kondisi wajib diisi.',
            'kondisi.array' => 'Kondisi harus dalam format array.',
            'kondisi.min' => 'Minimal satu kondisi harus dipilih.',
            'kondisi.*.exists' => 'Salah satu kondisi yang dipilih tidak valid.',
            'kondisi.*.required' => 'Setiap kondisi harus diisi.',
            'harga.required' => 'Harga wajib diisi.',
        ];
    }
}
