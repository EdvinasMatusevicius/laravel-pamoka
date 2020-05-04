<?php

declare(strict_types = 1);

namespace Modules\Product\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\Product\Entities\Product;
use Modules\Product\Enum\ProductTypeEnum;
use ReflectionException;

/**
 * Class ProductStoreRequest
 * @package Modules\Product\Http\Requests
 */
class ProductStoreRequest extends FormRequest
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
     * @throws ReflectionException
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0.01',
            'categories' => [
                'sometimes',
                'array',
            ],
            'active' => 'nullable|boolean',
            'image' => 'nullable|array',
            'image.*' => 'nullable|image',
            'type' => [
                'required',
                Rule::in(ProductTypeEnum::enumIds()),
            ],
        ];
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->after(function (Validator $validator) {
            if (
                ($this->isMethod('post') || $this->isMethod('put')) &&
                $this->slugExists()
            ) {
                $validator->errors()
                    ->add('slug', 'This slug already exists.');
            }
        });

        return $validator;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'description' => $this->getDescription(),
            'price' => $this->getPrice(),
            'active' => $this->getActive(),
            'type' => $this->getType(),
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return (string)$this->input('title');
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        $slugUnprepared = $this->input('slug');

        if (empty($slugUnprepared)) {
            $slugUnprepared = $this->getTitle();
        }

        return Str::slug(trim($slugUnprepared));
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->input('description');
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return (float)$this->input('price', 0.01);
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return (bool)$this->input('active');
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->input('categories', []);
    }

    /**
     * @return array
     */
    public function getSuppliers(): array
    {
        return $this->input('suppliers', []);
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->file('image', []);
    }

    /**
     * @return bool
     */
    protected function slugExists(): bool
    {
        return Product::query()
            ->where('slug', '=', $this->getSlug())
            ->exists();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->input('type');
    }
}
