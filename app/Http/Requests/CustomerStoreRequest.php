<?php
declare(strict_types=1);
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            Rule::unique('users')
        ],
            'password'=>'required|min:8|confirmed',
        ];
    }
    public function getData(): array{
        return [
            'name'=>$this->getName(),
            'email'=>$this->getEmail(),
            'password'=>$this->getHashPassword()
        ];
    }
    private function getName():string
    {
         return $this->input('name');
    }

    private function getEmail():string
    {
         return $this->input('email');
    }
    
    private function getHashPassword():string
    {
         return Hash::make($this->input('password'));
    }
}
