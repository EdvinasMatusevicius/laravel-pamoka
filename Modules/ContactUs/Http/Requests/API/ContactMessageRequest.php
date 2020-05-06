<?php

declare(strict_types = 1);

namespace Modules\ContactUs\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ContactMessageRequest
 * @package Modules\ContactUs\Http\Requests\API
 */
class ContactMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required',
        ];
    }

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
     * @return array
     */
    public function getData(): array
    {
        return [
            'client_name' => $this->getClientName(),
            'client_email' => $this->getClientEmail(),
            'message' => $this->getMessage(),
        ];
    }

    /**
     * @return string|null
     */
    private function getClientName(): ?string
    {
        return $this->input('name');
    }

    /**
     * @return string
     */
    private function getClientEmail(): string
    {
        return $this->input('email');
    }

    /**
     * @return string
     */
    private function getMessage(): string
    {
        return $this->input('message');
    }
}
