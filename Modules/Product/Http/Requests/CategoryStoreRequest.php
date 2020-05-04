<?php

declare(strict_types = 1);

namespace Modules\Product\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Modules\Product\Entities\Category;

/**
 * Class CategoryStoreRequest
 *
 * @package App\Http\Requests
 */
class CategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|string|min:3|max:255',
        ];
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance() {
        $validator = parent::getValidatorInstance();

        $validator->after(function(Validator $validator) {
            if ($this->slugExists()) {
                $validator->errors()
                    ->add('slug', 'This slug already exists.');
            }
        });

        return $validator;
    }

    /**
     * @return array
     */
    public function getData(): array {
        return [
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return (string)$this->input('title');
    }

    /**
     * @return string
     */
    public function getSlug() {
        $slugUnprepared = $this->input('slug');

        if (empty($slugUnprepared)) {
            $slugUnprepared = $this->getTitle();
        }

        return Str::slug(trim($slugUnprepared));
    }

    /**
     * @return bool
     */
    protected function slugExists(): bool {
        return Category::query()
            ->where('slug', '=', $this->getSlug())
            ->exists();
    }
}
