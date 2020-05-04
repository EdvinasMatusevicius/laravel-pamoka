<?php

declare(strict_types = 1);

namespace Modules\Product\Helpers;

/**
 * Class PriceFormatter
 * @package Modules\Product\Helpers
 */
class PriceFormatter
{
    /**
     * @param float $price
     * @param string $currencyCode
     * @return string
     */
    public function formatWithCurrencyCode(float $price, string $currencyCode = 'EUR'): string
    {
        return $price . ' ' . $currencyCode;
    }

    /**
     * @param float $price
     * @param int $decimal
     * @return string
     */
    public function formatPrice(float $price, int $decimal = 2): string
    {
        return number_format($price, $decimal);
    }
}