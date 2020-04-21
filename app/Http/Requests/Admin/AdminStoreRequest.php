<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class AdminStoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'=>'nullable|max:255',
            'last_name'=>'nullable|string|max:255',
            'email'=>'required|string|email|unique:admins|max:255',
            'password'=>'required|string|confirmed|min:8',
            'active'=>'boolean',
            'roles'=>'sometimes|array'
        ];
    }
    public function getData():array{
        return[
            'name'=>$this->getName(),
            'last_name'=>$this->getLastName(),
            'email'=>$this->getEmail(),
            'password'=>$this->getPass(),
            'active'=>$this->getActive(),
            'roles'=>$this->getRoles()

        ];
    }
    public function getName(): ?string{
        return $this->input('name');
    }
    public function getLastName(): ?string{
        return $this->input('last_name');
    }
    public function getEmail(): string{
        return $this->input('email');
    }
    public function getPass(): string{
        return $this->input('password');
    }
    public function getActive(): bool{
        return (bool)$this->input('active');
    }
    public function getRoles():array{
        return $this->input('roles',[]);
    }
    
}
