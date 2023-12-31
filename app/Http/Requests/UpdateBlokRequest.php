<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBlokRequest extends FormRequest
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

        $blokId = $this->route('blok');

        return [
            'nomor' => [
                'required',
                'integer',
                Rule::unique('bloks', 'nomor')->ignore($blokId->id),
            ]
        ];
    }
    public function messages(): array

    {
        return [
            'nomor.required' => 'Kolom nomor wajib diisi.',
            'nomor.integer' => 'Kolom nomor harus berupa bilangan bulat.',
            'nomor.unique' => 'Blok sudah terdaftar.'
        ];
    }
}
