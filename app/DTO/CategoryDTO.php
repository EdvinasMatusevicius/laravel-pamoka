<?php
declare(strict_types=1);
namespace App\DTO;

use App\Category;
use App\DTO\Abstracts\DTO;

class CategoryDTO extends DTO
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    protected function jsonData(): array
    {
        return [
            'title'=> $this->category->title,
            'slug'=>$this->category->slug,
        ];
    }
}