<?php

namespace Modules\ContactUs\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\ContactUs\Entities\ContactMessage;

class NewMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage=$contactMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('contactus::emails.new_message');
    }
}
