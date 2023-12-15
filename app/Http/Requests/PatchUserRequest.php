<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatchUserRequest extends FormRequest
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
            'username' => ['string', 'max:255'],
            'email' => ['string', 'max:255', 'email'],
            'password' => ['string', 'min:8', 'confirmed']
        ];
    }
}
