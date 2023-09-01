<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
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
            'seller' => 'required|exists:users,id',
            'metodeBayar' => 'required|in:Cash,Debit',
            'norek' => function ($attribute, $value, $fail) {
                if ($value === 'Cash' && !request()->has('bayar')) {
                    return $fail('The ' . $attribute . ' field is required when metodeBayar is Cash.');
                }
            },
            'bayar' => function ($attribute, $value, $fail) {
                if ($value === 'Debit' && !request()->has('norek')) {
                    return $fail('The ' . $attribute . ' field is required when metodeBayar is Debit.');
                }
            },
            'hp' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'seller.required' => 'Seller wajib diisi.',
            'seller.exists' => 'Seller tidak valid.',
            'metodeBayar.required' => 'Metode pembayaran wajib diisi.',
            'metodeBayar.in' => 'Metode pembayaran harus berupa Cash atau Debit.',
            'norek.required' => 'Nomor rekening wajib diisi saat metode pembayaran adalah Cash.',
            'bayar.required' => 'Jumlah bayar wajib diisi saat metode pembayaran adalah Debit.',
            'hp.required' => 'Nomor HP wajib diisi.',
            'nama.required' => 'Nama wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ];
    }
}
