<?php

namespace App\Listeners;

use App\Events\NewSpeedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewSpeedListener implements ShouldQueue
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
     * @param  NewSpeedEvent  $event
     * @return void
     */
    public function handle(NewSpeedEvent $event)
    {
        $event->broadcastOn();
    }
}
