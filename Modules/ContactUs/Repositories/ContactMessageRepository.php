<?php

declare(strict_types = 1);

namespace Modules\ContactUs\Repositories;

use Modules\ContactUs\Entities\ContactMessage;
use Modules\Core\Repositories\Repository;

/**
 * Class ContactMessageRepository
 * @package Modules\ContactUs\Repositories
 */
class ContactMessageRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return ContactMessage::class;
    }
}