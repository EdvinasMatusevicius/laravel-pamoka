<?php

namespace App\Listeners\API;

use App\Events\API\CustomerLoginEvent;
use App\Events\API\CustomerLogoutEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;

class CustomerAuthLogSubscriber
{
   public function subscribe(Dispatcher $event){
        $event->listen([
            CustomerLoginEvent::class,
            CustomerLogoutEvent::class,
        ],
        CustomerAuthLogListener::class
    );
   }
}
