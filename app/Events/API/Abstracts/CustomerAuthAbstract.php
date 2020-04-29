<?php

declare(strict_types = 1);

namespace App\Events\API\Abstracts;

use App\Events\API\Contracts\CustomerAuthContract;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

/**
 * Class CustomerAuthAbstract
 * @package App\Events\API\Abstracts
 */
abstract class CustomerAuthAbstract implements CustomerAuthContract
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    public $customer;
    /**
     * @var string
     */
    public $tokenId;
    /**
     * @var Carbon
     */
    public $eventTime;

    /**
     * Create a new event instance.
     *
     * @param User $customer
     * @param string $tokenId
     * @param Carbon $eventTime
     */
    public function __construct(User $customer, string $tokenId, Carbon $eventTime)
    {
        $this->customer = $customer;
        $this->tokenId = $tokenId;
        $this->eventTime = $eventTime;
    }

    /**
     * @return string
     */
    abstract public function getType(): string;
} 