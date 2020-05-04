<?php

declare(strict_types = 1);

namespace Modules\Product\Http\Requests;


/**
 * Class SupplierUpdateRequest
 * @package Modules\Product\Http\Requests
 */
class SupplierUpdateRequest extends SupplierStoreRequest
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
    public function rules(): array
    {
        return parent::rules();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'title' => $this->getTitle(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'address' => $this->getAddress(),
        ];
    }

    /**
     * @return bool
     */
    public function getDeleteLogo(): bool
    {
        return (bool)$this->input('delete_logo');
    }
}
