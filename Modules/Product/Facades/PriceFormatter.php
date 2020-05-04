<?php

declare(strict_types = 1);

namespace Modules\Product\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PriceFormatter
 *
 * @method static string formatWithCurrencyCode(float $price, string $currencyCode = 'EUR')
 * @method static string formatPrice(float $price, int $decimal = 2)
 *
 * @package Modules\Product\Facades
 */
class PriceFormatter extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'price-formatter';
    }
}