<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
    public function rules()
    {
        return [
            'nama' => 'required|max:125',
            'hp' => 'required|unique:members,hp',
            'alamat' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama member harus diisi.',
            'nama.max' => 'Nama member tidak boleh lebih dari 125 karakter.',
            'hp.required' => 'Nomor HP member harus diisi.',
            'hp.unique' => 'Nomor HP sudah terdaftar.',
            'alamat.required' => 'Alamat member harus diisi.',
            'alamat.max' => 'Alamat member tidak boleh lebih dari 255 karakter.',
        ];
    }
}
