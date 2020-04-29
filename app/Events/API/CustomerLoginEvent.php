<?php

declare(strict_types = 1);

namespace App\Events\API;

use App\Events\API\Abstracts\CustomerAuthAbstract;


class CustomerLoginEvent extends CustomerAuthAbstract
{
    public function getType(): string
    {
        return 'logged_in';
    }
}