<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Str;
use Modules\Product\Entities\Category;

class CategoryUpdateRequest extends CategoryStoreRequest
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
        return parent::rules();
    }
    protected function slugExists():bool{
        return Category::query()
        ->where('slug','=',$this->getSlug())
        ->where('id','!=',$this->route()
        ->parameter('category')->id)
        ->exists();
    }
}
