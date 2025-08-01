<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama jasa harus diisi.',
            'price.required' => 'Harga jasa harus diisi.',
            'price.min' => 'Harga tidak boleh kurang dari 0.',
        ];
    }
}
