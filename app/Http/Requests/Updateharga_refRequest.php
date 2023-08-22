<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Updateharga_refRequest extends FormRequest
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
        $karatId = $this->route('harga_ref')->karat_id;
        $inputHarga = rupiahToInt($this->input('harga'));

        return [
            'harga' => [
                'required',
                Rule::unique('harga_refs', 'harga')
                    ->where(function ($query) use ($karatId, $inputHarga) {
                        return $query->where('karat_id', $karatId)
                            ->where('harga', $inputHarga);
                    })
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'harga.required' => 'Kolom harga wajib diisi.',
        ];
    }
}
