<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeranjangRequest extends FormRequest
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
            'kodeBarcode' => 'required',
            'harga' => 'required',
            'hargaRugi' => 'required',
            'jenisTransaksi' => 'required|in:1,3',
        ];
    }

    public function messages(): array
    {
        return [
            'kodeBarcode.required' => 'Kode Barcode harus diisi.',
            'harga.required' => 'Harga harus diisi.',
            'hargaRugi.required' => 'Harga Rugi harus diisi.',
            'jenisTransaksi.required' => 'Jenis Transaksi harus diisi.',
            'jenisTransaksi.in' => 'Jenis Transaksi tidak diketahui.',
        ];
    }
}
