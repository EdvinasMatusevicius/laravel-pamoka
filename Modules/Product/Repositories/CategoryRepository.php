<?php

declare(strict_types = 1);

namespace Modules\Product\Repositories;

use Modules\Core\Repositories\Repository;
use Modules\Product\Entities\Category;

/**
 * Class CategoryRepository
 * @package Modules\Product\Repositories
 */
class CategoryRepository extends Repository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }
} 