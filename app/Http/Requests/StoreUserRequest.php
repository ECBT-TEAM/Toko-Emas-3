<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'nama' => 'required|max:125',
            'username' => 'required|max:125|unique:users,username',
            'password' => 'required|max:125|min:8',
            'cabang' => 'required|exists:cabangs,id',
            'role' => 'required|exists:roles,id',
            'status' => 'required|max:125',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 125 karakter.',
            'username.required' => 'Username harus diisi.',
            'username.max' => 'Username tidak boleh lebih dari 125 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.max' => 'Password tidak boleh lebih dari 125 karakter.',
            'password.min' => 'Password minimal harus memiliki 8 karakter.',
            'cabang.required' => 'Cabang harus dipilih.',
            'cabang.exists' => 'Cabang yang dipilih tidak valid.',
            'role.required' => 'Role harus dipilih.',
            'role_id.exists' => 'Role yang dipilih tidak valid.',
            'status.required' => 'Status harus diisi.',
            'status.max' => 'Status tidak boleh lebih dari 125 karakter.',
        ];
    }
}
