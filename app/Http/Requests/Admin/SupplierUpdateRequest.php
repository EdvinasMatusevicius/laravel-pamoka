<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends SupplierStoreRequest
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
        return parent::rules();
        
    }
    public function getData(): array
    {
        return [
            'title' => $this->getTitle(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'address' => $this->getAddress(),
        ];
    }
    public function getDeleteLogo(): bool
    {
        return (bool)$this->input('delete_logo');
    }
}
