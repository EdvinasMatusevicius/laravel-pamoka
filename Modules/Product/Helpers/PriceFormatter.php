<?php
declare(strict_types=1);
namespace Modules\Product\Helpers;

class PriceFormatter
{
    public function formatWithCurrencyCode(float $price, string $currencyCode = 'EUR'):string
    {
        return $price . ' ' . $currencyCode;
    }
    // public function formatPrice(float $price,int $)
}