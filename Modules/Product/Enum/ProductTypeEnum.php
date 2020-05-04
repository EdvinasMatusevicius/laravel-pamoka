<?php

declare(strict_types = 1);

namespace Modules\Product\Enum;

use App\Enum\Abstracts\Enumerable;
use ReflectionException;

/**
 * Class ProductTypeEnum
 * @package App\Enum
 */
class ProductTypeEnum extends Enumerable
{
    /**
     * @return ProductTypeEnum
     * @throws ReflectionException
     */
    final public static function physical(): ProductTypeEnum
    {
        return self::make('physical', 'Physical', 'Product is physical');
    }

    /**
     * @return ProductTypeEnum
     * @throws ReflectionException
     */
    final public static function virtual(): ProductTypeEnum
    {
        return self::make('virtual', 'Virtual', 'Product is virtual');
    }
}