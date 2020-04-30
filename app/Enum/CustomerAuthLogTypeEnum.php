<?php
declare(strict_types=1);
namespace App\Enum;

use App\Enum\Abstracts\Enumerable;

class CustomerAuthLogTypeEnum extends Enumerable
{
    final public static function logedIn():CustomerAuthLogTypeEnum
    {
        return self::make('logged_in',__('Logged In'));
    }
    final public static function logedOut():CustomerAuthLogTypeEnum
    {
        return self::make('logged_out',__('Logged out'));
    }
}