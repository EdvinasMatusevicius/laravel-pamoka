<?php

declare(strict_types = 1);

namespace Modules\Product\DTO;

use App\DTO\Abstracts\DTO;
use Modules\Product\Entities\Category;

/**
 * Class CategoryDTO
 * @package App\DTO
 */
class CategoryDTO extends DTO
{

    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryDTO constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return [
            'title' => $this->category->title,
            'slug' => $this->category->slug,
        ];
    }
}