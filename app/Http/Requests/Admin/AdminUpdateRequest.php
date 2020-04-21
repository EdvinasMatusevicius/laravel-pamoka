<?php

namespace App\Http\Requests\Admin;

use App\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;

class AdminUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'=>'nullable|max:255',
            'last_name'=>'nullable|string|max:255',
            'email'=>'required|string|email|max:255',
            'password'=>'nullable|string|confirmed|min:8',
            'active'=>'boolean',
            'roles'=>'sometimes|array'
        ];
    }
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function(Validator $validator){
            if($this->emailExists()){
                $validator->errors()->add('email','email already exists');
            }
        });
        return $validator;

    }
    public function getData():array{
        $data = [
            'name'=>$this->getName(),
            'last_name'=>$this->getLastName(),
            'email'=>$this->getEmail(),
            'active'=>$this->getActive()

        ];
        if(!empty($this->input('password'))){
            $data['password']= $this->getPass();
        }
        return $data;
    }
    private function getName(): ?string{
        return $this->input('name');
    }
    private function getLastName(): ?string{
        return $this->input('last_name');
    }
    private function getEmail(): string{
        return $this->input('email');
    }
    private function getPass(): string{
        $password=$this->input('password');
        if(!empty($password)){
            return Hash::make($password);
        }
        return null;
    }
    private function getActive(): bool{
        return (bool)$this->input('active');
    }
    private function emailExists(): bool{
        return Admin::query()->where('email','=',$this->input('email'))->where('id','!=',$this->route()->parameter('admin')->id)
        ->exists();
    }
    public function getRoles():array{
        return $this->input('roles',[]);
    }
}
