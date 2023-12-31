<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateKotakRequest extends FormRequest
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
            'nomor' => [
                'required',
                'integer',
                Rule::unique('kotaks')
                    ->where('jenis', request()->input('jenis'))
                    ->ignore($this->kotak)
            ],
            'berat' => 'required|numeric|min:0',
            'jenis' => 'required|in:Kotak,Patung',
        ];
    }

    public function messages(): array
    {
        return [
            'nomor.required' => 'Nomor harus diisi.',
            'nomor.integer' => 'Nomor harus berupa angka.',
            'nomor.unique' => 'Nomor :input untuk jenis ' . strtolower(request()->input('jenis')) . ' sudah digunakan.',
            'berat.required' => 'Kolom berat wajib diisi.',
            'berat.numeric' => 'Kolom berat harus berupa angka.',
            'berat.min' => 'Kolom berat harus memiliki nilai minimum :min.',
            'jenis.required' => 'Kolom jenis wajib diisi.',
            'jenis.in' => 'Kolom jenis harus salah satu dari: Kotak, Patung.',
        ];
    }
}
