<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Storeharga_refRequest extends FormRequest
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
        return [
            'harga' => 'required',
            'karat' => [
                'required',
                'integer',
                'exists :karats,id',
                Rule::unique('harga_refs', 'karat_id')->where(function ($query) {
                    return $query->where('harga', rupiahToInt($this->harga));
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'harga.required' => 'Kolom harga wajib diisi.',
            'karat.required' => 'Kolom karat wajib diisi.',
            'karat.integer' => 'Kolom karat harus berupa bilangan bulat.',
            'karat.exists' => 'Pilihan karat tidak valid.',
            'karat.unique' => 'Kombinasi harga dan jenis karat sudah terdaftar.',
        ];
    }
}
