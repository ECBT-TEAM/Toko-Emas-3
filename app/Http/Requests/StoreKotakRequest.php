<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKotakRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'berat' => 'required|numeric|min:0',
            'jenis' => 'required|in:Kotak,Kalung',
            'blok' => 'required|integer|exists:bloks,id',
            'kategori' => 'required|integer|exists:kategoris,id'
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Kolom nama wajib diisi.',
            'nama.string' => 'Kolom nama harus berupa teks.',
            'nama.max' => 'Kolom nama tidak boleh lebih dari :max karakter.',
            'berat.required' => 'Kolom berat wajib diisi.',
            'berat.numeric' => 'Kolom berat harus berupa angka.',
            'berat.min' => 'Kolom berat harus memiliki nilai minimum :min.',
            'jenis.required' => 'Kolom jenis wajib diisi.',
            'jenis.in' => 'Kolom jenis harus salah satu dari: Kotak, Kalung.',
            'blok.required' => 'Kolom blok wajib diisi.',
            'blok.integer' => 'Kolom blok harus berupa bilangan bulat.',
            'blok.exists' => 'Blok yang dipilih tidak valid.',
            'kategori.required' => 'Kolom kategori wajib diisi.',
            'kategori.integer' => 'Kolom kategori harus berupa bilangan bulat.',
            'kategori.exists' => 'Kategori yang dipilih tidak valid.'
        ];
    }
}
