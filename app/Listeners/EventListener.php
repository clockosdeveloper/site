<?php

namespace App\Listeners;

use App\Events\AvailableUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListener Implements ShouldQueue
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
     * @param  AvailableUser  $event
     * @return void
     */
    public function handle(AvailableUser $event)
    {
        flash()->success('alert.execute_quest');
    }
}
