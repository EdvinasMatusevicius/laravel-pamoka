<?php

declare(strict_types = 1);

namespace Modules\Product\Repositories;

use Modules\Core\Repositories\Repository;
use Modules\Product\Entities\Supply;

/**
 * Class SupplyRepository
 * @package Modules\Product\Repositories
 */
class SupplyRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Supply::class;
    }
} 