<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'nama' => 'required|max:125',
            'username' => [
                'required',
                'max:125',
                Rule::unique('users', 'username')->ignore($userId->id),
            ],
            'cabang' => 'required|exists:cabangs,id',
            'role' => 'required|exists:roles,id',
            'password' => 'nullable|min:8'
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
            'cabang.required' => 'Cabang harus dipilih.',
            'cabang.exists' => 'Cabang yang dipilih tidak valid.',
            'role.required' => 'Role harus dipilih.',
            'role_id.exists' => 'Role yang dipilih tidak valid.',
            'password.min' => 'Password minimal harus memiliki 8 karakter.',
        ];
    }
}
