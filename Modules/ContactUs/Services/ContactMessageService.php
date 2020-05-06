<?php

declare(strict_types = 1);

namespace Modules\ContactUs\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\ContactUs\Entities\ContactMessage;
use Modules\ContactUs\Repositories\ContactMessageRepository;

/**
 * Class ContactMessageService
 * @package Modules\ContactUs\Services
 */
class ContactMessageService
{
    /**
     * @var ContactMessageRepository
     */
    private $messageRepository;

    /**
     * ContactMessageService constructor.
     * @param ContactMessageRepository $messageRepository
     */
    public function __construct(ContactMessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param array $data
     * @return ContactMessage|Model
     */
    public function storeData(array $data): ContactMessage
    {
        return $this->messageRepository->create($data);
    }
}