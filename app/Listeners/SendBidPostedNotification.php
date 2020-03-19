<?php

namespace App\Listeners;

use App\Events\BidPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\BidPostedNotification;
use Illuminate\Support\Facades\Notification;

class SendBidPostedNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle(BidPosted $event)
    {
        Notification::send($event->bid->job->user, new BidPostedNotification($event->bid));
    }
}
