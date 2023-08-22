<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
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
    public function rules()
    {
        $memberId = $this->route('member')->id;

        return [
            'nama' => [
                'required',
                'max:125',
            ],
            'hp' => [
                'required',
                Rule::unique('members', 'hp')->where(function ($query) use ($memberId) {
                    return $query->where('nama', $this->nama)
                        ->where('id', '<>', $memberId);
                }),
            ],
            'alamat' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama member harus diisi.',
            'nama.max' => 'Nama member tidak boleh lebih dari 125 karakter.',
            'hp.required' => 'Nomor HP member harus diisi.',
            'hp.unique' => 'Kombinasi nama dan HP sudah terdaftar.',
            'alamat.required' => 'Alamat member harus diisi.',
            'alamat.max' => 'Alamat member tidak boleh lebih dari 255 karakter.',
        ];
    }
}
