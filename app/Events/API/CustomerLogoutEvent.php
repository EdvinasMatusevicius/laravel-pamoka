<?php

declare(strict_types = 1);

namespace App\Events\API;

use App\Events\API\Abstracts\CustomerAuthAbstract;

/**
 * Class CustomerLogoutEvent
 * @package App\Events\API
 */
class CustomerLogoutEvent extends CustomerAuthAbstract
{

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'logged_out';
    }
}