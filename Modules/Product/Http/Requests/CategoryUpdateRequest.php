<?php

declare(strict_types = 1);

namespace Modules\Product\Http\Requests;

use Modules\Product\Entities\Category;

/**
 * Class CategoryUpdateRequest
 *
 * @package App\Http\Requests
 */
class CategoryUpdateRequest extends CategoryStoreRequest
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
        return parent::rules();
    }

    /**
     * @return bool
     */
    protected function slugExists(): bool {
        return Category::query()
            ->where('slug', '=', $this->getSlug())
            ->where('id', '!=', $this->route()->parameter('category'))
            ->exists();
    }

}
