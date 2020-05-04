<?php
declare(strict_types=1);
namespace Modules\Product\Facades;

use Illuminate\Support\Facades\Facade;

class PriceFormatter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Price-formatter';
    }
}