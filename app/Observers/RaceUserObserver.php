<?php

namespace App\Observers;

use App\Models\RaceUser;
use App\Http\Controllers\NotificationController;

class RaceUserObserver
{
    /**
     * Handle the race user "created" event.
     *
     * @param  \App\Models\RaceUser  $raceUser
     * @return void
     */
    public function created(RaceUser $raceUser)
    {
        //  \Log::info('Race created Successfully');
        $NotificationController = new NotificationController();
      
        $notificationMessage = [
                                    "title" => 'Memmber Joined',
                                    "body" =>  "New Member Joined Successfuly!",
                                    "icon" => url('/logo.png')
                                 ];
        $NotificationController->sendPushNotification($notificationMessage);
    }

    /**
     * Handle the race user "updated" event.
     *
     * @param  \App\Models\RaceUser  $raceUser
     * @return void
     */
    public function updated(RaceUser $raceUser)
    {
        //
    }

    /**
     * Handle the race user "deleted" event.
     *
     * @param  \App\Models\RaceUser  $raceUser
     * @return void
     */
    public function deleted(RaceUser $raceUser)
    {
        //
    }

    /**
     * Handle the race user "restored" event.
     *
     * @param  \App\Models\RaceUser  $raceUser
     * @return void
     */
    public function restored(RaceUser $raceUser)
    {
        //
    }

    /**
     * Handle the race user "force deleted" event.
     *
     * @param  \App\Models\RaceUser  $raceUser
     * @return void
     */
    public function forceDeleted(RaceUser $raceUser)
    {
        //
    }
}
