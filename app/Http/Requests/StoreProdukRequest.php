<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
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
            'kategori' => 'required|exists:kategoris,id',
            'model' => 'required',
            'karat' => 'required|exists:karats,id',
            'sumber' => 'required|exists:suppliers,id',
            'kotak' => 'required|exists:kotaks,id',
            'berat' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'kategori.required' => 'Kategori harus dipilih.',
            'kategori.exists' => 'Kategori yang dipilih tidak valid.',
            'model.required' => 'Model harus dipilih.',
            'karat.required' => 'Karat harus dipilih.',
            'karat.exists' => 'Karat yang dipilih tidak valid.',
            'sumber.required' => 'Sumber harus dipilih.',
            'sumber.exists' => 'Sumber yang dipilih tidak valid.',
            'kotak.required' => 'Kotak harus dipilih.',
            'kotak.exists' => 'Kotak yang dipilih tidak valid.',
            'berat.required' => 'Berat harus diisi.',
            'berat.numeric' => 'Berat harus berupa angka.',
        ];
    }
}
