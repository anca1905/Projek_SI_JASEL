<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'nullable',
            'password' => 'nullable',
        ];
    }

    public function withValidator($validator)
    {
        if ($this->isMethod('post')) {
            $validator->sometimes('password', 'required', function ($data) {
                return true;
            });
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'role' => 'Peran',
            'password' => 'Password',
        ];
    }
}
