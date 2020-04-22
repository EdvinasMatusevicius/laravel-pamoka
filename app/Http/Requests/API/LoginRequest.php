<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'email'=>'required|email|string|max:255|exists:users',
            'password'=>'required|string|min:8'

        ];
    }
    public function getCredentials(): array{
        return $this->only(['email','password']);
    }
}
