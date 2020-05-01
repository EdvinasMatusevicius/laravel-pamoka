<?php
declare(strict_types=1);
namespace Modules\Product\DTO;

use App\DTO\Abstracts\DTO;
use Modules\Product\Entities\Category;

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