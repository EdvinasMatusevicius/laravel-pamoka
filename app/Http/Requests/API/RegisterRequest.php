<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends LoginRequest
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
            'name'=>'required|string|max:100',
            'email'=>'required|email|string|unique:users',
            'password'=>'required|min:8|confirmed'
        ];
    }
    public function getRegisterData():array
    {
        return[
            'name' => $this->getCustomerName(),
            'email'=> $this->getCustomerEmail(),
            'password'=>$this->getCustomerPassword()
        ];
    }
    private function getCustomerName():string
    {
        return $this->input('name');
    }
    private function getCustomerEmail():string
    {
        return $this->input('email');
    }
    private function getCustomerPassword():string
    {
        return Hash::make((string)$this->input('password'));
    }
}
