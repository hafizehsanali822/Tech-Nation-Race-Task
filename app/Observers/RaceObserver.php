<?php

namespace App\Observers;

use App\Models\Race;
use App\Http\Controllers\NotificationController;


class RaceObserver
{
    /**
     * Handle the race "created" event.
     *
     * @param  \App\Models\Race  $race
     * @return void
     */
    public function created(Race $race)
    {
      //  \Log::info('Race created Successfully');
        $NotificationController = new NotificationController();
      
        $notificationMessage = [
                                    "title" => 'New Race Created',
                                    "body" =>  $race->title . " created Successfuly!",
                                    "icon" => url('/logo.png')
                                 ];
        $NotificationController->sendPushNotification($notificationMessage);
    }

    /**
     * Handle the race "updated" event.
     *
     * @param  \App\Models\Race  $race
     * @return void
     */
    public function updated(Race $race)
    {
        //
    }

    /**
     * Handle the race "deleted" event.
     *
     * @param  \App\Models\Race  $race
     * @return void
     */
    public function deleted(Race $race)
    {
        //
    }

    /**
     * Handle the race "restored" event.
     *
     * @param  \App\Models\Race  $race
     * @return void
     */
    public function restored(Race $race)
    {
        //
    }

    /**
     * Handle the race "force deleted" event.
     *
     * @param  \App\Models\Race  $race
     * @return void
     */
    public function forceDeleted(Race $race)
    {
        //
    }
}
