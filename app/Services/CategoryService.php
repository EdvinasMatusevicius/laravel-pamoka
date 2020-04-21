<?php

declare(strict_types = 1);

namespace App\Services;

use App\Category;
use App\DTO\Abstracts\CollectionDTO;
use App\DTO\CategoryDTO;

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

        $data = Category::query()->where('active','=',1)->get();

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
            ->where('active','=',1)
            ->where('slug', '=', $slug)
            ->firstOrFail();

        return new CategoryDTO($category);
    }
} 
