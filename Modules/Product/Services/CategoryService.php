<?php

declare(strict_types = 1);

namespace Modules\Product\Services;

use App\DTO\Abstracts\CollectionDTO;
use Modules\Product\DTO\CategoryDTO;
use Modules\Product\Entities\Category;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService
{
    /**
     * @return CollectionDTO
     */
    public function getAllForApi(): CollectionDTO
    {
        $categoryDTO = new CollectionDTO();

        $data = Category::query()
            ->get();

        foreach ($data as $item) {
            $categoryDTO->pushItem(new CategoryDTO($item));
        }

        return $categoryDTO;
    }

    /**
     * @param string $slug
     * @return CategoryDTO
     */
    public function getBySlugForApi(string $slug): CategoryDTO
    {
        $category = Category::query()
            ->where('slug', '=', $slug)
            ->firstOrFail();

        return new CategoryDTO($category);
    }
}