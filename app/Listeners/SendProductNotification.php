<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Notifications\ProductNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendProductNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductCreated  $event
     * @return void
     */
    public function handle(ProductCreated $event)
    {
        //
        $email = config('mailto');
        $notify = explode(",", $email);

        foreach ($notify as $email) {
            Notification::route('mail', $email)
                ->notify(new ProductNotification($event->product));
        }
    }

    public function subscribe($events)
    {
    }
}
