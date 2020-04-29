<?php

declare(strict_types = 1);

namespace App\Events\API\Contracts;

/**
 * Interface CustomerAuthContract
 * @package App\Events\API\Contracts
 */
interface CustomerAuthContract
{
    /**
     * @return string
     */
    public function getType(): string;
} 