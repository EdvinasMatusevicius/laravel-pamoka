<?php

declare(strict_types = 1);

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class SupplierStoreRequest
 * @package App\Http\Requests\Admin
 */
class SupplierStoreRequest extends FormRequest
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
            'title' => 'required|max:100|string',
            'logo' => 'nullable|image',
            'phone' => 'required|min:4|max:30',
            'email' => 'required|email|max:100',
            'address' => 'nullable|max:255',
        ];
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
            'logo' => $this->getLogoPath(),
        ];
    }

    /**
     * @return string
     */
    protected function getTitle(): string
    {
        return $this->input('title');
    }

    /**
     * @return string
     */
    protected function getPhone(): string
    {
        return (string)$this->input('phone');
    }

    /**
     * @return string
     */
    protected function getEmail(): string
    {
        return $this->input('email');
    }

    /**
     * @return string|null
     */
    protected function getAddress(): ?string
    {
        return $this->input('address');
    }

    /**
     * @return string|null
     */
    public function getLogoPath(): ?string
    {
        $image = $this->getLogo();

        if ($image == null) {
            return null;
        }

        return $image->store('supply');
    }

    /**
     * @return UploadedFile|null
     */
    public function getLogo(): ?UploadedFile
    {
        return $this->file('logo');
    }


}
