<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255|min:4',
            'email'=>['required','email:filter','max:255','min:3',
            Rule::unique('users')->ignore($this->route()->parameter('customer')->id)
        ],
            'password'=>'nullable|min:8|same:password_confirmation',
            'password_confirmation'=>'nullable|min:8|same:password',
        ];
    }
    public function getName():string
    {
         return $this->input('name');
    }

    public function getEmail():string
    {
         return $this->input('email');
    }
    
    public function getHashPassword():?string
    {
        $pass = $this->input('password');
        if($pass !== null){
            return Hash::make($pass);
        }
        return $pass;
    }
}
